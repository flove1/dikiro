<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'email' => $this->faker->email(),
            'password' => $this->faker->password(),
            'name' => $this->faker->name()
        ];
    }
}
