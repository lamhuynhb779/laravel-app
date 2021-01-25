<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
// Unit test [start]
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use App\Models\Article;
// Unit test [end]

abstract class TestCase extends BaseTestCase
{
    // Unit test [start]
    use CreatesApplication;
    // use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        // Artisan::call('db:seed');
        $users = Article::factory()->count(5)->suspended()->make();
    }
    // Unit test [end]
}
