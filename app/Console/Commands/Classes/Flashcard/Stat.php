<?php


namespace App\Console\Commands\Classes\Flashcard;


use App\Console\Commands\Flashcard;
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
     * @return void
     */
    public function get()
    {
        $user = User::get()->first();
        $cards = Card::with(['last_answer' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->get()->toArray();
        $total = 0;
        $correct = 0;
        $incorrect = 0;
        $not_answered = 0;
        $total_answers_percent = 0;
        $correct_answers_percent = 0;
        foreach ($cards as $card) {
            if (!is_array($card['last_answer'])) {
                $not_answered++;
            } else {
                switch ($card['last_answer']['status']) {
                    case 0:
                        $incorrect++;
                        break;
                    case 1:
                        $correct++;
                        break;
                }
            }
            $total++;
        }
        $result = [];
        if ($total > 0) {
            $total_answers_percent = round((($correct + $incorrect) / $total) * 100);
            $correct_answers_percent = round(($correct / $total) * 100);
        }
        array_push($result, [
            'total' => $total,
            'total_answers' => $total_answers_percent . '%',
            'correct_answers' => $correct_answers_percent . '%'
        ]);
        $this->flashcard->table(
            ['Total Questions', '% of Answered Questions', '% Of Questions with Correct Answer'],
            $result
        );
    }
}
