<?php


namespace App\Console\Commands\Classes\Flashcard;

use App\Console\Commands\Flashcard;
use App\Console\Commands\Interfaces\FlashcardPromptInterface;

class Prompt
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
     * Prompt for input
     *
     * @param FlashcardPromptInterface $flashcardPrompt
     * @return mixed
     */
    public function get_input(FlashcardPromptInterface $flashcardPrompt): mixed
    {
        return $flashcardPrompt->init($this->flashcard);
    }
}
