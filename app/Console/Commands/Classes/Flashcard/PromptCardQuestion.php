<?php


namespace App\Console\Commands\Classes\Flashcard;

use App\Console\Commands\Flashcard;
use App\Console\Commands\Interfaces\FlashcardPromptInterface;

class PromptCardQuestion implements FlashcardPromptInterface
{
    /**
     * Prompt for getting card question
     *
     * @param Prompt
     * @return string
     */
    public function init($prompt): string
    {
        $question = $prompt->ask('Enter the question');
        if (!is_string($question)) {
            $prompt->line('<fg=red>Please fill the input correctly.</>');
            $question = $prompt->ask('Enter the question');
        }
        return $question;
    }
}
