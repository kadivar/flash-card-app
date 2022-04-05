<?php


namespace App\Console\Commands\Classes\Flashcard;


use App\Console\Commands\Flashcard;

class Help
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
     * Print help content
     *
     * @return void
     */
    public function print_help(): void
    {
        $this->flashcard->line('<bg=blue;fg=white>Welcome to Flash Card App!</>');
        $this->flashcard->line('<bg=blue;fg=white>Here is your personal desk, so choose which one you need:</>');
        $this->flashcard->line(' ');
        $this->flashcard->line('<fg=green>1 . Create a flashcard</>');
        $this->flashcard->line('By choosing this item you will be asked for a "Question" and its "Answer" to create a new flash card.');
        $this->flashcard->line(' ');
        $this->flashcard->line('<fg=green>2 . List all flashcards</>');
        $this->flashcard->line('By choosing this item a list of all cards will be printed.');
        $this->flashcard->line(' ');
        $this->flashcard->line('<fg=green>3 . Practice</>');
        $this->flashcard->line('By choosing this item you will be able to choose each card you want to practice from printed list.');
        $this->flashcard->line(' ');
        $this->flashcard->line('<fg=green>4 . Stats</>');
        $this->flashcard->line('By choosing this item you can be aware of your study progress.');
        $this->flashcard->line(' ');
        $this->flashcard->line('<fg=green>5 . Reset</>');
        $this->flashcard->line('By choosing this item you can reset all your study history and start again from the beginning.');
        $this->flashcard->line(' ');
        $this->flashcard->line('<fg=green>6 . Exit</>');
        $this->flashcard->line('By choosing this item you exit to get some rest :)');
        $this->flashcard->line(' ');
    }
}
