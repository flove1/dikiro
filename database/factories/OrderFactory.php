<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'price' => $this->faker->randomNumber()*100,
            'count' => $this->faker->randomNumber(),
            'desc' => $this->faker->text(),
        ];
    }
}
