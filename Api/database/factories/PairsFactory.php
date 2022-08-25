<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\pairs>
 */
class PairsFactory extends Factory
{


    public function definition()
    {
        return [
            'from_id' => rand(1, 20),
            'to_id' => rand(1, 20),
            'conversion' => $this->faker->randomFloat(4, 0.0001, 10.0000),
            'nbreRequest' => 0
        ];
    }
}
