<?php

namespace App\Console\Commands;

use App\Models\Card;
use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

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
        $picked_operation = $this->prompt_operation_id();
        switch ($picked_operation) {
            case 1:
                $question = $this->prompt_card_question();
                $answer = $this->prompt_card_answer();
                $this->create_card($question, $answer);
                break;
            case 2:
                $this->list_cards();
                break;
            case 3:
                $this->print_practice_history();
                $card_id = $this->prompt_card_id();
                $this->practice($card_id);
                break;
            case 4:
                $this->print_practice_stats();
                break;
            case 5:
                $this->reset();
                break;
            case 6:
                $this->line('<bg=blue;fg=white>Good luck!</>');
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
     * List questions with their practice status
     *
     * @return void
     */
    public function print_practice_history()
    {
        $user = User::find(1);
        $cards = Card::with(['last_answer' => function($query) use ($user){
            $query->where('user_id', $user->id);
        }])->get()->toArray();
        $total = 0;
        $correct = 0;
        $incorrect = 0;
        $not_answered = 0;
        $result = [];
        foreach ($cards as $card){
            if(!is_array($card['last_answer'])){
                $card_id = '<fg=yellow>'.$card['id'].'</>';
                $status = '<fg=yellow>Not answered</>';
                $not_answered++;
            } else {
                switch ($card['last_answer']['status']){
                    case 0:
                        $card_id = '<fg=red>'.$card['id'].'</>';
                        $status = '<fg=red>Incorrect</>';
                        $incorrect++;
                        break;
                    case 1:
                        $card_id = '<fg=green>'.$card['id'].'</>';
                        $status = '<fg=green>Correct</>';
                        $correct++;
                        break;
                }
            }
            array_push($result, [
                'ID' => $card_id,
                'question' => $card['question'],
                'status' => $status
            ]);
            $total++;
        }
        array_push($result, [
            ' ' => ' ',
            'question' => '<fg=green> % of completion</>',
            'status' => '<fg=green> ' . round(($correct/$total)*100) . '% </>'
        ]);
        $this->table(
            ['ID', 'Question', 'Status'],
            $result
        );
    }

    /**
     * Show study statistics
     *
     * @return void
     */
    public function print_practice_stats()
    {
        $user = User::find(1);
        $cards = Card::with(['last_answer' => function($query) use ($user){
            $query->where('user_id', $user->id);
        }])->get()->toArray();
        $total = 0;
        $correct = 0;
        $incorrect = 0;
        $not_answered = 0;
        foreach ($cards as $card){
            if(!is_array($card['last_answer'])){
                $not_answered++;
            } else {
                switch ($card['last_answer']['status']){
                    case 0:
                        $incorrect++;
                        break;
                    case 1:
                        $correct++;
                        break;
                }
            }
            $total++;
        }
        $result = [];
        array_push($result, [
            'total' => $total,
            'total_answers' => round((($correct+$incorrect)/$total)*100) . '%',
            'correct_answers' => round(($correct/$total)*100) . '%'
        ]);
        $this->table(
            ['Total Questions', '% of Answered Questions', '% Of Questions with Correct Answer'],
            $result
        );
    }

    /**
     * Prompt from main menu operation options
     *
     * @return int
     */
    public function prompt_operation_id(): int
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
     * Prompt for getting card id
     *
     * @return int
     */
    public function prompt_card_id(): int
    {
        $card_id = $this->ask('Please fill card Id');
        if (!is_numeric($card_id)) {
            $this->line('<fg=red>You can just fill a number!</>');
            $card_id = $this->ask('Please fill card Id');
        }
        return (int)$card_id;
    }

    /**
     * Get question from prompt
     *
     * @return string
     */
    public function prompt_card_question(): string
    {
        $question = $this->ask('Enter the question');
        if (!is_string($question)) {
            $this->line('<fg=red>Please fill the input correctly.</>');
            $question = $this->ask('Enter the question');
        }
        return $question;
    }

    /**
     * Get answer from prompt
     *
     * @return string
     */
    public function prompt_card_answer(): string
    {
        $answer = $this->ask('Enter the answer');
        if (!is_string($answer)) {
            $this->line('<fg=red>Please fill the input correctly.</>');
            $answer = $this->ask('Enter the answer');
        }
        return $answer;
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
     * Create a new flash card
     *
     * @param $question string
     * @param $answer string
     *
     * @return void
     */
    public function create_card(string $question, string $answer)
    {
        try{
            $card_id = Card::create([
                'box_id' => 1,
                'question' => $question,
                'answer' => $answer
            ])?->id;
            $this->line('<fg=green>New card successfully created.</>');
            return $card_id;
        } catch (\Exception $e) {
            $this->line('<fg=yellow>Error:</>');
            $this->line('<fg=yellow>'.$e->getMessage().'</>');
        }
    }

    /**
     * Practice specific card
     *
     * @return void
     */
    public function practice($card_id)
    {
        $user = User::find(1);
        $card = Card::with('last_answer', 'answers')->where([
            'id' => $card_id
        ])->first();
        $card_array = $card->toArray();
        $can_practice = false;
        if(!is_array($card_array['last_answer'])){
            $can_practice = true;
        } else {
            $can_practice = match ($card_array['last_answer']['status']) {
                0 => true,
                1 => false,
            };
        }
        if(!$can_practice){
            $this->line('<fg=red>You can not practice again, please choose another one.</>');
            $card_id = $this->prompt_card_id();
            $this->practice($card_id);
        }
        if($can_practice){
            $answer = $this->prompt_card_answer();
            if($card_array['answer'] == $answer){
                $status = 1;
                $this->line('<fg=green>The answer is correct.</>');
            } else {
                $status = 0;
                $this->line('<fg=red>The answer is incorrect.</>');
            }
            try{
                UserAnswer::create([
                    'card_id' => $card->id,
                    'user_id' => $user->id,
                    'answer' => $answer,
                    'status' => $status
                ]);
            } catch (\Exception $e) {
                $this->line('<fg=yellow>Error:</>');
                $this->line('<fg=yellow>'.$e->getMessage().'</>');
            }
        } else {
            $this->line('<fg=red>You can not practice again, please choose another one.</>');
        }
        $card_id = $this->prompt_card_id();
        $this->practice($card_id);
    }

    /**
     * Reset personal study data
     *
     * @return void
     */
    public function reset()
    {
        try{
            $user = User::find(1);
            UserAnswer::where([
                'user_id' =>$user->id
            ])->forceDelete();
            $this->line('<fg=green>All personal stats reset.</>');
        } catch (\Exception $e) {
            $this->line('<fg=yellow>Error:</>');
            $this->line('<fg=yellow>'.$e->getMessage().'</>');
        }
    }
}
