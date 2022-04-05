<?php


namespace App\Console\Commands\Classes\Flashcard;


use App\Console\Commands\Flashcard;
use App\Models\User;
use App\Models\UserAnswer;

class Reset
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
     * Reset personal study data
     *
     * @return false
     */
    public function init(): bool
    {
        try {
            $user = User::get()->first();
            UserAnswer::where([
                'user_id' => $user->id
            ])->forceDelete();
            return true;
        } catch (\Exception $e) {
            $this->flashcard->line('<fg=yellow>Error:</>');
            $this->flashcard->line('<fg=yellow>' . $e->getMessage() . '</>');
            return false;
        }
    }
}
