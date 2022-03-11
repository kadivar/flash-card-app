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
            'answer' => $this->faker->paragraph,
            'status' => $this->faker->randomElement([0, 1]),
            'description' => $this->faker->paragraph
        ];
    }
}
