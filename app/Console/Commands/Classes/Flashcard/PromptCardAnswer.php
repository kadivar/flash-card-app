<?php


namespace App\Console\Commands\Classes\Flashcard;


use App\Console\Commands\Flashcard;
use App\Console\Commands\Interfaces\FlashcardPromptInterface;

class PromptCardAnswer implements FlashcardPromptInterface
{
    /**
     * Prompt for getting card answer
     *
     * @param Prompt
     * @return string
     */
    public function init($prompt): string
    {
        $answer = $prompt->ask('Enter the answer');
        if (!is_string($answer)) {
            $prompt->line('<fg=red>Please fill the input correctly.</>');
            $answer = $prompt->ask('Enter the answer');
        }
        return $answer;
    }
}
