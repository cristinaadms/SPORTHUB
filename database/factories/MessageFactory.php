<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\Partida;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition(): array
    {
        return [
            'conteudo' => $this->faker->sentence(),
            'user_id' => User::factory(),
            'partida_id' => Partida::factory(), // assumes Partida factory could be added later
        ];
    }
}
