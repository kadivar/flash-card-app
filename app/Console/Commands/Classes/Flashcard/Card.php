<?php


namespace App\Console\Commands\Classes\Flashcard;


use App\Console\Commands\Flashcard;
use App\Models\Box;
use App\Models\Card as CardModel;

class Card
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
     * List all flash cards
     *
     * @return array
     */
    public function list(): array
    {
        return CardModel::all(['id', 'question', 'answer'])->toArray();
    }

    /**
     * Create a new flash card
     *
     * @param $question string
     * @param $answer string
     *
     * @return void
     */
    public function create(string $question, string $answer)
    {
        try {
            $box = Box::get()->first();
            $card_id = CardModel::create([
                'box_id' => $box->id,
                'question' => $question,
                'answer' => $answer
            ])?->id;
            $this->flashcard->line('<fg=green>New card successfully created.</>');
            return $card_id;
        } catch (\Exception $e) {
            $this->flashcard->line('<fg=yellow>Error:</>');
            $this->flashcard->line('<fg=yellow>' . $e->getMessage() . '</>');
        }
    }
}
