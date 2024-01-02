<?php

namespace Database\Factories;

use App\Models\Spot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $spot_id = Spot::all()->random()->id;
        $quantity = $this->faker->numberBetween(1, 10);

        return [
            'user_id' => User::all()->random()->id,
            'spot_id' => $spot_id,
            'quantity' => $quantity,
            'price' => Spot::where('id', $spot_id)->first()->price * $quantity,
        ];
    }
}
