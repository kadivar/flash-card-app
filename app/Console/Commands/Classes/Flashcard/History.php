<?php


namespace App\Console\Commands\Classes\Flashcard;


use App\Console\Commands\Flashcard;
use App\Models\Card;
use App\Models\User;

class History
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
     * List questions with their practice status
     *
     * @return void
     */
    public function get_history()
    {
        $user = User::get()->first();
        $cards = Card::with(['last_answer' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->get()->toArray();
        $total = 0;
        $correct = 0;
        $incorrect = 0;
        $not_answered = 0;
        $progress = 0;
        $result = [];
        foreach ($cards as $card) {
            if (!is_array($card['last_answer'])) {
                $card_id = '<fg=yellow>' . $card['id'] . '</>';
                $status = '<fg=yellow>Not answered</>';
                $not_answered++;
            } else {
                switch ($card['last_answer']['status']) {
                    case 0:
                        $card_id = '<fg=red>' . $card['id'] . '</>';
                        $status = '<fg=red>Incorrect</>';
                        $incorrect++;
                        break;
                    case 1:
                        $card_id = '<fg=green>' . $card['id'] . '</>';
                        $status = '<fg=green>Correct</>';
                        $correct++;
                        break;
                }
            }
            array_push($result, [
                'ID' => $card_id,
                'question' => $card['question'],
                'status' => $status
            ]);
            $total++;
        }
        if ($total > 0) {
            $progress = round(($correct / $total) * 100);
        }
        array_push($result, [
            ' ' => ' ',
            'question' => '<fg=green> % of completion</>',
            'status' => '<fg=green> ' . $progress . '% </>'
        ]);
        $this->flashcard->table(
            ['ID', 'Question', 'Status'],
            $result
        );
    }
}
