<?php
/**
 * ANA RITA VIEIRA DE ALMEIDA 35456
 */
namespace Database\Factories;

use App\Models\Spot;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Spot>
 */
class SpotFactory extends Factory
{
    protected $model = Spot::class;

    public function definition(): array
    {

        return [
            'name' => fake()->text(70),
            'description' => fake()->text(5000),
            'location' => fake()->text(20),
            'price' => fake()->randomFloat(2, 0, 500),
            'type_id' => Type::all()->random()->id,
            'villager' => User::all()->random()->id,
            'image' => 'spot-image-placeholder.jpeg',
        ];
    }
}