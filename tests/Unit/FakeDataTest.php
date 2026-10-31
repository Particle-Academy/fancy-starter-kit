<?php

use Database\Factories\Support\FakeData;
use Illuminate\Container\Container;

afterEach(function () {
    Container::setInstance(null);
});

/**
 * @return list<string>
 */
function fakeDataSequence(FakeData $fake): array
{
    $values = [];
    for ($i = 0; $i < 20; $i++) {
        $values[] = $fake->name();
        $values[] = $fake->safeEmail();
        $values[] = $fake->unique()->safeEmail();
    }

    return $values;
}

test('name is a capitalised first and last name', function () {
    $fake = new FakeData(seed: 1);

    for ($i = 0; $i < 200; $i++) {
        expect($fake->name())->toMatch('/^[A-Z][a-z]+ [A-Z][a-z]+$/');
    }
});

test('safe email is a valid address on a reserved example domain', function () {
    $fake = new FakeData(seed: 1);

    for ($i = 0; $i < 200; $i++) {
        $email = $fake->safeEmail();

        expect(filter_var($email, FILTER_VALIDATE_EMAIL))->not->toBeFalse("{$email} is not a valid address");
        expect($email)->toMatch('/^[a-z0-9._]+@example\.(com|net|org)$/');
    }
});

test('the same seed produces the same sequence', function () {
    expect(fakeDataSequence(new FakeData(seed: 42)))->toBe(fakeDataSequence(new FakeData(seed: 42)));
});

test('a different seed produces a different sequence', function () {
    expect(fakeDataSequence(new FakeData(seed: 42)))->not->toBe(fakeDataSequence(new FakeData(seed: 43)));
});

test('reseeding restarts the sequence', function () {
    $fake = new FakeData(seed: 7);
    $first = [$fake->name(), $fake->safeEmail()];

    $fake->seed(7);

    expect([$fake->name(), $fake->safeEmail()])->toBe($first);
});

test('an unseeded generator is not a fixed sequence', function () {
    expect(fakeDataSequence(new FakeData))->not->toBe(fakeDataSequence(new FakeData));
});

test('unique never repeats a value for the same formatter', function () {
    $fake = new FakeData(seed: 3);

    $emails = [];
    for ($i = 0; $i < 2000; $i++) {
        $emails[] = $fake->unique()->safeEmail();
    }

    expect(array_unique($emails))->toHaveCount(2000);
});

test('unique is one proxy so uniqueness spans calls', function () {
    $fake = new FakeData;

    expect($fake->unique())->toBe($fake->unique());
});

test('unique can be reset', function () {
    $fake = new FakeData;
    $before = $fake->unique();

    expect($fake->unique(reset: true))->not->toBe($before);
});

test('unique throws once it runs out of values', function () {
    $fake = new FakeData(seed: 5);

    // There are fewer distinct names than this, so the loop cannot finish.
    for ($i = 0; $i < 20_000; $i++) {
        $fake->unique(maxRetries: 1)->name();
    }
})->throws(OverflowException::class);

test('unique rejects anything that is not a formatter', function () {
    $fake = new FakeData;

    foreach (['seed', 'unique', 'shared', 'noSuchFormatter'] as $method) {
        expect(fn () => $fake->unique()->{$method}())->toThrow(BadMethodCallException::class);
    }
});

test('shared is one instance per container', function () {
    $first = FakeData::shared();

    expect(FakeData::shared())->toBe($first);

    Container::setInstance(new Container);

    expect(FakeData::shared())->not->toBe($first);
});
