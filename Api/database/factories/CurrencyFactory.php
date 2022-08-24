<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\currencies>
 */
class CurrencyFactory extends Factory
{

    public function definition()
    {

        return [
            'code' => $this->faker->currency_code,
            'name' => $this->faker->currency,
            'symbol' => $this->faker->unique()->randomLetter
        ];
    }
}
