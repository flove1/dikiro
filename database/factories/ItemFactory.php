<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'price' => $this->faker->randomNumber(),
            'count' => $this->faker->randomNumber(),
            'desc' => $this->faker->text(),
            'img_path' => 'img/1.png'
        ];
    }
}
