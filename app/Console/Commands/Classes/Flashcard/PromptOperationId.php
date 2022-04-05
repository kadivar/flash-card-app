<?php


namespace App\Console\Commands\Classes\Flashcard;


use App\Console\Commands\Interfaces\FlashcardPromptInterface;

class PromptOperationId implements FlashcardPromptInterface
{
    /**
     * Prompt from main menu operation options
     *
     * @param Prompt
     * @return int
     */
    public function init($prompt): int
    {
        $picked_operation = $prompt->ask('Please choose one of listed options (Just number of Item)');
        if (!is_numeric($picked_operation)) {
            $prompt->line('<fg=red>You can just fill a number!</>');
            $picked_operation = $prompt->ask('Please choose one of listed options (Just Item number)');
        }
        if ($picked_operation < 0 || $picked_operation > 6) {
            $prompt->line('<fg=red>Please just fill a number between 1 to 6.</>');
            $picked_operation = $prompt->ask('Please choose one of listed options (Just Item number)');
        }
        return (int)$picked_operation;
    }
}
