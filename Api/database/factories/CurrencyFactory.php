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
            'name' => $this->faker->currency,
            'code' => $this->faker->currency_code,
            'symbol' => $this->faker->unique()->randomLetter
        ];
    }
}
