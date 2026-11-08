<?php

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

// Boots the application without RefreshDatabase, so this reads the configuration the suite
// would use without ever connecting to it.
uses(TestCase::class);

// The Feature suite runs RefreshDatabase, which drops every table on the default connection.
// A process environment that already sets DB_CONNECTION (a hosting setup, or a local tool that
// gives every process its dev database) must not be able to point the suite at a real database.
test('the suite runs on an in-memory sqlite database whatever the environment says', function () {
    expect(config('database.default'))->toBe('sqlite')
        ->and(config('database.connections.sqlite.database'))->toBe(':memory:')
        ->and(config('database.connections.sqlite.url'))->toBeEmpty()
        ->and(DB::connection()->getDriverName())->toBe('sqlite')
        ->and(DB::connection()->getDatabaseName())->toBe(':memory:');
});
