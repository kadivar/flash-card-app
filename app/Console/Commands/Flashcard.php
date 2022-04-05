<?php

namespace App\Console\Commands;

use App\Console\Commands\Classes\Flashcard\History;
use App\Console\Commands\Classes\Flashcard\Practice;
use App\Console\Commands\Classes\Flashcard\Prompt;
use App\Console\Commands\Classes\Flashcard\PromptCardAnswer;
use App\Console\Commands\Classes\Flashcard\PromptCardId;
use App\Console\Commands\Classes\Flashcard\PromptCardQuestion;
use App\Console\Commands\Classes\Flashcard\PromptOperationId;
use App\Console\Commands\Classes\Flashcard\Card;
use App\Console\Commands\Classes\Flashcard\Reset;
use App\Console\Commands\Classes\Flashcard\Stat;
use Illuminate\Console\Command;
use App\Helpers\Flashcard as Helper;
use App\Console\Commands\Classes\Flashcard\Help;

class Flashcard extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flashcard:interactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will present the main menu of flashcard app.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $is_initialized = Helper::is_initialized();
        if (!$is_initialized) {
            $this->line('<fg=red>Please complete your setup with running seeders.</>');
            exit;
        }
        $help = new Help($this);
        $prompt = new Prompt($this);
        $card = new Card($this);
        $history = new History($this);
        $practice = new Practice($this);
        $stat = new Stat($this);
        $reet = new Reset($this);
        $help->print_help();
        $picked_operation = $prompt->get_input(new PromptOperationId());
        switch ($picked_operation) {
            case 1:
                $question = $prompt->get_input(new PromptCardQuestion());
                $answer = $prompt->get_input(new PromptCardAnswer());
                $card->create($question, $answer);
                break;
            case 2:
                $cards = $card->list();
                $this->table(
                    ['ID', 'Question', 'Answer'],
                    $cards,
                );
                break;
            case 3:
                $history = $history->get();
                $this->table(
                    ['ID', 'Question', 'Status'],
                    $history
                );
                $card_id = $prompt->get_input(new PromptCardId());
                $practice->init($card_id);
                break;
            case 4:
                $result = $stat->get();
                $this->table(
                    ['Total Questions', '% of Answered Questions', '% Of Questions with Correct Answer'],
                    $result
                );
                break;
            case 5:
                $result = $reet->init();
                if ($result) {
                    $this->line('<fg=green>All personal stats reset.</>');
                }
                break;
            case 6:
                $this->line('<bg=blue;fg=white>Good luck!</>');
                break;
        }
        return 0;
    }
}
