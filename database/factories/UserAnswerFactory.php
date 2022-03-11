<?php

namespace Database\Factories;

use App\Models\Box;
use App\Models\Card;
use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAnswer>
 */
class UserAnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserAnswer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $status = $this->faker->randomElement([0, 1]);
        switch ($status){
            case 0:
                $question = $this->faker->paragraph;
                $answer = $this->faker->paragraph;
                break;
            case 1:
                $question = $this->faker->paragraph;
                $answer = $question;
                break;
            default:
                $question = $this->faker->paragraph;
                $answer = $this->faker->paragraph;
        }

        return [
            'user_id' => function () {
                $default_admin = User::where('id', 1)->exists();
                if($default_admin){
                    return 1;
                }
                return User::admin_factory()->count(1)->create()->id;
            },
            'card_id' => function () {
                return Card::factory()->create()->id;
            },
            'answer' => $answer,
            'status' => $status,
            'description' => $this->faker->paragraph
        ];
    }
}
