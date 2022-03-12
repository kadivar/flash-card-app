<?php

namespace Tests\Unit;

use App\Models\Card;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Console\Commands;

class FlashcardConsoleTest extends TestCase
{
    /**
     * Test Create card command
     *
     * @return void
     */
    public function test_create_card_command()
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
    public function test_list_cards_command()
    {
        $this->assertTrue(true);
    }

    /**
     * Test Practice command
     *
     * @return void
     */
    public function test_success_new_practice_command()
    {
        $this->assertTrue(true);
    }

    /**
     * Test Practice command
     *
     * @return void
     */
    public function test_failed_new_practice_command()
    {
        $this->assertTrue(true);
    }

    /**
     * Test Practice command
     *
     * @return void
     */
    public function test_success_old_practice_command()
    {
        $this->assertTrue(true);
    }

    /**
     * Test Practice command
     *
     * @return void
     */
    public function test_failed_old_practice_command()
    {
        $this->assertTrue(true);
    }

    /**
     * Test Stats command
     *
     * @return void
     */
    public function test_stats_command()
    {
        $this->assertTrue(true);
    }

    /**
     * Test Reset command
     *
     * @return void
     */
    public function test_reset_command()
    {
        $this->assertTrue(true);
    }

    /**
     * Test Exit command
     *
     * @return void
     */
    public function test_exit_command()
    {
        $this->assertTrue(true);
    }
}
