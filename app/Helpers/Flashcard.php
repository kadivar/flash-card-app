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

    /**
     * Get answer counts
     *
     * @param $cards
     * @return array
     */
    public static function get_answer_counts($cards): array
    {
        $cards = array_map(function ($index, $card) {
            $status = match ($card['last_answer']['status']) {
                -1 => 'not_answered',
                0 => 'incorrect',
                1 => 'correct',
            };
            $card['status'] = $status;
            return $card;
        }, array_keys($cards), $cards);
        $counts = array_count_values(array_column($cards, 'status'));
        $counts['correct'] = $counts['correct'] ?? 0;
        $counts['incorrect'] = $counts['incorrect'] ?? 0;
        $counts['not_answered'] = $counts['not_answered'] ?? 0;
        return $counts;
    }
}
