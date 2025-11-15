<?php

namespace Database\Factories;

use App\Models\Local;
use App\Models\Partida;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AvaliacaoFactory extends Factory
{
    public function definition(): array
    {
        $local = Local::factory()->create();
        $partida = Partida::factory()->create(['local_id' => $local->id]);

        return [
            'avaliador_id' => User::factory(),
            'avaliado_id' => User::factory(),
            'partida_id' => $partida->id,
            'local_id' => $local->id,
            'estrelas' => fake()->numberBetween(1, 5),
            'tipo' => 'local',
        ];
    }
}
