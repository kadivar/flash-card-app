<?php


namespace App\Helpers;


use App\Models\Box;
use App\Models\User;
use Illuminate\Support\Facades\App;

class Flashcard
{
    /**
     * Check app initial setup
     *
     * @return boolean
     */
    public static function is_initialized(): bool
    {
        $is_running_test = App::runningUnitTests();
        $is_in_console = App::runningInConsole();
        $user = User::get()->first();
        $box = Box::get()->first();
        if (!$is_running_test && (!$user || !$box)) {
            return false;
        }
        return true;
    }
}
