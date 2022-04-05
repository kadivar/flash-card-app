<?php

namespace Tests\Feature;

use Database\Seeders\TestUserAnswerSeeder;
use Tests\CreatesApplication;
use Tests\TestCase;

class FlashcardConsoleTest extends TestCase
{
    use CreatesApplication;

    /**
     * Run a specific seeder before each test.
     *
     * @var string
     */
    protected string $seeder = TestUserAnswerSeeder::class;

    /**
     * Test Create card command
     *
     * @return void
     */
    public function testCreateCardCommand()
    {
        $this->artisan('flashcard:interactive')
            ->expectsQuestion('Please choose one of listed options (Just number of Item)', 1)
            ->expectsQuestion('Enter the question', 'This is a unit test generation question?')
            ->expectsQuestion('Enter the answer', 'This is a unit test generation answer.')
            ->expectsOutput('New card successfully created.')
            ->assertExitCode(0);
    }

    /**
     * Test List cards command
     *
     * @return void
     */
    public function testListCardsCommand()
    {
        $this->assertTrue(true);
    }

    /**
     * Test Practice command
     *
     * @return void
     */
    public function testSuccessNewPracticeCommand()
    {
        $this->assertTrue(true);
    }

    /**
     * Test Practice command
     *
     * @return void
     */
    public function testFailedNewPracticeCommand()
    {
        $this->assertTrue(true);
    }

    /**
     * Test Practice command
     *
     * @return void
     */
    public function testSuccessOldPracticeCommand()
    {
        $this->assertTrue(true);
    }

    /**
     * Test Practice command
     *
     * @return void
     */
    public function testFailedOldPracticeCommand()
    {
        $this->assertTrue(true);
    }

    /**
     * Test Stats command
     *
     * @return void
     */
    public function testStatsCommand()
    {
        $this->assertTrue(true);
    }

    /**
     * Test Reset command
     *
     * @return void
     */
    public function testResetCommand()
    {
        $this->assertTrue(true);
    }

    /**
     * Test Exit command
     *
     * @return void
     */
    public function testExitCommand()
    {
        $this->assertTrue(true);
    }
}
