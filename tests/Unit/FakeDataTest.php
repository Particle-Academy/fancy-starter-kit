<?php

namespace Tests\Unit;

use BadMethodCallException;
use Database\Factories\Support\FakeData;
use Illuminate\Container\Container;
use OverflowException;
use PHPUnit\Framework\TestCase;

class FakeDataTest extends TestCase
{
    protected function tearDown(): void
    {
        Container::setInstance(null);

        parent::tearDown();
    }

    public function test_name_is_a_capitalised_first_and_last_name(): void
    {
        $fake = new FakeData(seed: 1);

        for ($i = 0; $i < 200; $i++) {
            $this->assertMatchesRegularExpression('/^[A-Z][a-z]+ [A-Z][a-z]+$/', $fake->name());
        }
    }

    public function test_safe_email_is_a_valid_address_on_a_reserved_example_domain(): void
    {
        $fake = new FakeData(seed: 1);

        for ($i = 0; $i < 200; $i++) {
            $email = $fake->safeEmail();

            $this->assertNotFalse(filter_var($email, FILTER_VALIDATE_EMAIL), "{$email} is not a valid address");
            $this->assertMatchesRegularExpression('/^[a-z0-9._]+@example\.(com|net|org)$/', $email);
        }
    }

    public function test_the_same_seed_produces_the_same_sequence(): void
    {
        $this->assertSame($this->sequence(new FakeData(seed: 42)), $this->sequence(new FakeData(seed: 42)));
    }

    public function test_a_different_seed_produces_a_different_sequence(): void
    {
        $this->assertNotSame($this->sequence(new FakeData(seed: 42)), $this->sequence(new FakeData(seed: 43)));
    }

    public function test_reseeding_restarts_the_sequence(): void
    {
        $fake = new FakeData(seed: 7);
        $first = [$fake->name(), $fake->safeEmail()];

        $fake->seed(7);

        $this->assertSame($first, [$fake->name(), $fake->safeEmail()]);
    }

    public function test_an_unseeded_generator_is_not_a_fixed_sequence(): void
    {
        $this->assertNotSame($this->sequence(new FakeData), $this->sequence(new FakeData));
    }

    public function test_unique_never_repeats_a_value_for_the_same_formatter(): void
    {
        $fake = new FakeData(seed: 3);

        $emails = [];
        for ($i = 0; $i < 2000; $i++) {
            $emails[] = $fake->unique()->safeEmail();
        }

        $this->assertCount(2000, array_unique($emails));
    }

    public function test_unique_is_one_proxy_so_uniqueness_spans_calls(): void
    {
        $fake = new FakeData;

        $this->assertSame($fake->unique(), $fake->unique());
    }

    public function test_unique_can_be_reset(): void
    {
        $fake = new FakeData;
        $before = $fake->unique();

        $this->assertNotSame($before, $fake->unique(reset: true));
    }

    public function test_unique_throws_once_it_runs_out_of_values(): void
    {
        $fake = new FakeData(seed: 5);

        $this->expectException(OverflowException::class);

        // There are fewer distinct names than this, so the loop cannot finish.
        for ($i = 0; $i < 20_000; $i++) {
            $fake->unique(maxRetries: 1)->name();
        }
    }

    public function test_unique_rejects_anything_that_is_not_a_formatter(): void
    {
        $fake = new FakeData;

        foreach (['seed', 'unique', 'shared', 'noSuchFormatter'] as $method) {
            try {
                $fake->unique()->{$method}();
                $this->fail("unique()->{$method}() should have thrown");
            } catch (BadMethodCallException) {
                $this->addToAssertionCount(1);
            }
        }
    }

    public function test_shared_is_one_instance_per_container(): void
    {
        $first = FakeData::shared();

        $this->assertSame($first, FakeData::shared());

        Container::setInstance(new Container);

        $this->assertNotSame($first, FakeData::shared());
    }

    /**
     * @return list<string>
     */
    private function sequence(FakeData $fake): array
    {
        $values = [];
        for ($i = 0; $i < 20; $i++) {
            $values[] = $fake->name();
            $values[] = $fake->safeEmail();
            $values[] = $fake->unique()->safeEmail();
        }

        return $values;
    }
}
