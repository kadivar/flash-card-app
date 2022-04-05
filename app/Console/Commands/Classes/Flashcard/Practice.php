<?php


namespace App\Console\Commands\Classes\Flashcard;


use App\Console\Commands\Flashcard;
use App\Models\Card;
use App\Models\User;
use App\Models\UserAnswer;

class Practice
{
    /**
     * The Flashcard console command instance.
     *
     * @var Flashcard
     */
    protected Flashcard $flashcard;

    /**
     * Create a class instance.
     *
     * @return void
     */
    public function __construct($flashcard)
    {
        $this->flashcard = $flashcard;
    }

    /**
     * Practice specific card
     *
     * @return void
     */
    public function init($card_id)
    {
        $prompt = new Prompt($this->flashcard);
        $history = new History($this->flashcard);
        $user = User::get()->first();
        $card = Card::with('last_answer', 'answers')->where([
            'id' => $card_id
        ])->first();
        if (!$card) {
            $this->flashcard->line('<fg=red>Please enter a valid card ID.</>');
            $card_id = $prompt->get_input(new PromptCardId());
            self::init($card_id);
        }
        $card_array = $card->toArray();
        $can_init = false;
        if (!is_array($card_array['last_answer'])) {
            $can_init = true;
        } else {
            $can_init = match ($card_array['last_answer']['status']) {
                0 => true,
                1 => false,
            };
        }
        if (!$can_init) {
            $this->flashcard->line('<fg=red>You can not practice again, please choose another one.</>');
            $card_id = $prompt->get_input(new PromptCardId());
            self::init($card_id);
        }
        if ($can_init) {
            $answer = $prompt->get_input(new PromptCardAnswer());
            if ($card_array['answer'] == $answer) {
                $status = 1;
                $this->flashcard->line('<fg=green>The answer is correct.</>');
            } else {
                $status = 0;
                $this->flashcard->line('<fg=red>The answer is incorrect.</>');
            }
            try {
                UserAnswer::create([
                    'card_id' => $card->id,
                    'user_id' => $user->id,
                    'answer' => $answer,
                    'status' => $status
                ]);
            } catch (\Exception $e) {
                $this->flashcard->line('<fg=yellow>Error:</>');
                $this->flashcard->line('<fg=yellow>' . $e->getMessage() . '</>');
            }
        } else {
            $this->flashcard->line('<fg=red>You can not practice again, please choose another one.</>');
        }
        $history->get_history();
        $card_id = $prompt->get_input(new PromptCardId());
        self::init($card_id);
    }
}
