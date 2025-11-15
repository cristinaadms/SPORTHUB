<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LocalFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => fake()->company().' Arena',
            'latitude' => fake()->latitude(-23.6, -23.4),
            'longitude' => fake()->longitude(-46.7, -46.5),
            'imagem' => null,
        ];
    }
}
