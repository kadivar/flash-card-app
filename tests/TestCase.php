<?php

namespace Tests;

use Database\Seeders\TestUserAnswerSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Run a specific seeder before each test.
     *
     * @var string
     */
    protected string $seeder = TestUserAnswerSeeder::class;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected bool $seed = true;
}
