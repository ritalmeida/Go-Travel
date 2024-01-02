<?php
/**
 * ANA RITA VIEIRA DE ALMEIDA 35456
 */
namespace Database\Factories;

use App\Models\User;
use App\Models\Spot;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{

    /**
     * Define the model's default state.
     * 
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tittle' => fake()->text(50),
            'comments' => fake()->text(500),
            'rating' => fake()->numberBetween(1, 5),
            'spot_id' => Spot::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ];
    }
}