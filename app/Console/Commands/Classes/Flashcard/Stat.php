<?php


namespace App\Console\Commands\Classes\Flashcard;


use App\Console\Commands\Flashcard;
use App\Helpers\Flashcard as Helper;
use App\Models\Card;
use App\Models\User;

class Stat
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
     * Show study statistics
     *
     * @return array
     */
    public function get(): array
    {
        $user = User::get()->first();
        $cards = Card::with(['last_answer' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->get()->toArray();
        $counts = Helper::get_answer_counts($cards);
        $total = count($cards);
        $correct = $counts['correct'];
        $incorrect = $counts['incorrect'];
        $total_answers_percent = $total > 0 ? (round((($correct + $incorrect) / $total) * 100)) : 0;
        $correct_answers_percent = $total > 0 ? (round(($correct / $total) * 100)) : 0;
        $result = [];
        array_push($result, [
            'total' => $total,
            'total_answers' => $total_answers_percent . '%',
            'correct_answers' => $correct_answers_percent . '%'
        ]);
        return $result;
    }
}
