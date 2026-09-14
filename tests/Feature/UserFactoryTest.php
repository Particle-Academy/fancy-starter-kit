<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_user_factory_makes_distinct_users(): void
    {
        $users = User::factory()->count(50)->create();

        $this->assertCount(50, $users->pluck('email')->unique());
        $this->assertTrue($users->every(fn (User $user) => $user->name !== ''));
    }
}
