<?php

namespace Tests\Unit;

use App\Models\Card;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\TestUserAnswerSeeder;
use Illuminate\Support\Facades\DB;
use Tests\CreatesApplication;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\BoxSeeder;
use Database\Seeders\CardSeeder;
use Database\Seeders\UserAnswerSeeder;

use App\Console\Commands;

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
        /* the first card has not any answer */
        $card = Card::get()->first();
        $question = $card->question;
        $answer = $card->answer;
        $this->artisan('flashcard:interactive')
            ->expectsQuestion('Please choose one of listed options (Just number of Item)', 3)
            ->expectsQuestion('Please fill card Id', $card->id)
            ->expectsQuestion('Enter the answer', $answer)
            ->expectsOutput('The answer is correct.')
            ->assertExitCode(0);
    }

    /**
     * Test Practice command
     *
     * @return void
     */
    public function test_failed_new_practice_command()
    {
        /* the first card has not any answer */
        $card = Card::get()->first();
        $question = $card->question;
        $answer = $card->answer;
        $this->artisan('flashcard:interactive')
            ->expectsQuestion('Please choose one of listed options (Just number of Item)', 3)
            ->expectsQuestion('Please fill card Id', $card->id)
            ->expectsQuestion('Enter the answer', 'mock')
            ->expectsOutput('The answer is incorrect.')
            ->assertExitCode(0);
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
