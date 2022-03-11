<?php

namespace Database\Factories;

use App\Models\Box;
use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Card::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'box_id' => function () {
                $any_current_box = Box::all()?->first();
                if($any_current_box){
                    return $any_current_box->id;
                }
                return Box::factory()->create()->id;
            },
            'question' => $this->faker->paragraph,
            'answer' => $this->faker->paragraph,
            'description' => $this->faker->paragraph
        ];
    }
}
