<?php


namespace App\Console\Commands\Classes\Flashcard;


use App\Console\Commands\Interfaces\FlashcardPromptInterface;

class PromptCardId implements FlashcardPromptInterface
{
    /**
     * Prompt for getting card id
     *
     * @param Prompt
     * @return int
     */
    public function init($prompt): int
    {
        $card_id = $prompt->ask('Please fill card Id');
        if (!is_numeric($card_id)) {
            $prompt->line('<fg=red>You can just fill a number!</>');
            $card_id = $prompt->ask('Please fill card Id');
        }
        return (int)$card_id;
    }
}
