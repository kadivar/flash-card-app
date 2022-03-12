<?php

namespace App\Console\Commands;

use App\Models\Card;
use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Console\Command;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
        $this->print_help();
        $picked_operation = $this->choose_operation();
        switch ($picked_operation) {
            case 1:
                $new_card_detail = $this->get_new_card_detail();
                $this->create_card($new_card_detail);
                break;
            case 2:
                $this->list_cards();
                break;
            case 3:
                $card_id = 0;
                $this->show_practice_history();
                $this->practice($card_id);
                break;
            case 4:
                $this->show_stats();
                break;
            case 5:
                $this->reset();
                break;
        }

        return 0;
    }

    /**
     * Print help content
     *
     * @return void
     */
    public function print_help()
    {
        $this->line('<bg=blue;fg=white>Welcome to Flash Card App!</>');
        $this->line('<bg=blue;fg=white>Here is your personal desk, so choose which one you need:</>');
        $this->line(' ');
        $this->line('<fg=green>1 . Create a flashcard</>');
        $this->line('By choosing this item you will be asked for a "Question" and its "Answer" to create a new flash card.');
        $this->line(' ');
        $this->line('<fg=green>2 . List all flashcards</>');
        $this->line('By choosing this item a list of all cards will be printed.');
        $this->line(' ');
        $this->line('<fg=green>3 . Practice</>');
        $this->line('By choosing this item you will be able choose each card you want to practice from printed list.');
        $this->line(' ');
        $this->line('<fg=green>4 . Stats</>');
        $this->line('By choosing this item you can be aware of you study progress.');
        $this->line(' ');
        $this->line('<fg=green>5 . Reset</>');
        $this->line('By choosing this item you can reset all you study history and start again from the beginning.');
        $this->line(' ');
        $this->line('<fg=green>6 . Exit</>');
        $this->line('By choosing this item you exit have som rest :)');
        $this->line(' ');
    }

    /**
     * Prompt from main menu operation options
     *
     * @return int
     */
    public function choose_operation(): int
    {
        $picked_operation = $this->ask('Please choose one of listed options (Just number of Item)');
        if (!is_numeric($picked_operation)) {
            $this->line('<fg=red>You can just fill a number!</>');
            $picked_operation = $this->ask('Please choose one of listed options (Just Item number)');
        }
        if ($picked_operation < 0 || $picked_operation > 6) {
            $this->line('<fg=red>Please just fill a number between 1 to 6.</>');
            $picked_operation = $this->ask('Please choose one of listed options (Just Item number)');
        }
        return (int)$picked_operation;
    }

    /**
     * Create a new flash card
     *
     * @return int|array
     */
    public function get_new_card_detail(): int|array
    {
        $question = $this->ask('Enter the question');
        if (!is_string($question)) {
            $this->line('<fg=red>Please fill the input correctly.</>');
            $question = $this->ask('Enter the question');
        }
        $answer = $this->ask('Enter the answer');
        if (!is_string($answer)) {
            $this->line('<fg=red>Please fill the input correctly.</>');
            $answer = $this->ask('Enter the answer');
        }
        return [
            'question' => $question,
            'answer' => $answer
        ];
    }

    /**
     * Create a new flash card
     *
     * @return void
     */
    public function create_card($new_card_detail)
    {
        $question = $new_card_detail['question'];
        $answer = $new_card_detail['answer'];

    }

    /**
     * List all flash cards
     *
     * @return void
     */
    public function list_cards()
    {
        $this->table(
            ['ID', 'Question', 'Answer'],
            Card::all(['id', 'question', 'answer'])->toArray(),
        );
    }

    /**
     * List questions with their practice status
     *
     * @return void
     */
    public function show_practice_history()
    {
        $cards = Card::with(['last_answer' => function($query) {
                $query->where('user_id', 1);
            }])->get()->toArray();
        $total = 0;
        $correct = 0;
        $incorrect = 0;
        $not_answered = 0;
        $result = [];
        foreach ($cards as $card){
            if(!is_array($card['last_answer'])){
                $status = '<fg=yellow>Not answered</>';
                $not_answered++;
            } else {
                switch ($card['last_answer']['status']){
                    case 0:
                        $status = '<fg=red>Incorrect</>';
                        $incorrect++;
                        break;
                    case 1:
                        $status = '<fg=green>Correct</>';
                        $correct++;
                        break;
                }
            }
            array_push($result, [
                'question' => $card['question'],
                'status' => $status
            ]);
            $total++;
        }
        array_push($result, [
            'question' => '<fg=green> % of completion</>',
            'status' => '<fg=green> ' . round(($correct/$total)*100) . '% </>'
        ]);
        $this->table(
            ['Question', 'Status'],
            $result
        );
    }

    /**
     * Practice specific card
     *
     * @return void
     */
    public function practice($card_id)
    {

    }

    /**
     * Get study statistics
     *
     * @return void
     */
    public function show_stats()
    {

    }

    /**
     * Reset personal study data
     *
     * @return void
     */
    public function reset()
    {

    }
}
