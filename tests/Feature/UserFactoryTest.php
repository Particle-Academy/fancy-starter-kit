<?php

use App\Models\User;

test('the user factory makes distinct users', function () {
    $users = User::factory()->count(50)->create();

    expect($users->pluck('email')->unique())->toHaveCount(50);
    expect($users->every(fn (User $user) => $user->name !== ''))->toBeTrue();
});
