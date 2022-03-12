<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\Card;
use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class TestUserAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* run core seeders */
        $this->call(AdminUserSeeder::class);
        $this->call(BoxSeeder::class);
        /* do test dependency magics */
        $user = User::get()->first();
        $box = Box::get()->first();
        $mock_cards = [
            ['box_id' => $box->id, 'question' => 'q1', 'answer' => 'a1'],
            ['box_id' => $box->id, 'question' => 'q2', 'answer' => 'a2'],
            ['box_id' => $box->id, 'question' => 'q3', 'answer' => 'a3'],
            ['box_id' => $box->id, 'question' => 'q4', 'answer' => 'a4'],
            ['box_id' => $box->id, 'question' => 'q5', 'answer' => 'a5']
        ];
        $mock_answers = [
            ['user_id' => $user->id, 'answer' => 'mock', 'status' => 1],
            ['user_id' => $user->id, 'answer' => 'mock', 'status' => 0],
            ['user_id' => $user->id, 'answer' => 'mock', 'status' => 1],
            ['user_id' => $user->id, 'answer' => 'mock', 'status' => 0],
        ];
        $i = 1;
        foreach ($mock_cards as $mock_card){
            $card_id = Card::insertGetId($mock_card);
            if($i <= 1){
                $i++;
                continue;
            }
            foreach ($mock_answers as $mock_answer){
                if($mock_answer['status'] == 1){
                    $mock_answer['answer'] = $mock_card['answer'];
                }
                $mock_answer['card_id'] = $card_id;
                UserAnswer::insertGetId($mock_answer);
            }

        }
    }
}
