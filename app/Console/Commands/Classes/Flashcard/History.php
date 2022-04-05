<?php


namespace App\Console\Commands\Classes\Flashcard;


use App\Console\Commands\Flashcard;
use App\Models\Card;
use App\Models\User;
use App\Helpers\Flashcard as Helper;

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
    public function get()
    {
        $user = User::get()->first();
        $cards = Card::with(['last_answer' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->get()->toArray();
        $result = array_map(function ($index, $card) {
            $item = [];
            $status = match ($card['last_answer']['status']) {
                -1 => '<fg=yellow>Not answered</>',
                0 => '<fg=red>Incorrect</>',
                1 => '<fg=green>Correct</>',
            };
            $item['id'] = $card['id'];
            $item['question'] = $card['question'];
            $item['status'] = $status;
            return $item;
        }, array_keys($cards), $cards);
        $counts = Helper::get_answer_counts($cards);
        $total = count($cards);
        $correct = $counts['correct'];
        $progress = $total > 0 ? (round(($correct / $total) * 100)) : 0;
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
