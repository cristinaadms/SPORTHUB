<?php

namespace Database\Factories;

use App\Models\Local;
use App\Models\Partida;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partida>
 */
class PartidaFactory extends Factory
{
    protected $model = Partida::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->sentence(3),
            'descricao' => $this->faker->paragraph(),
            'data' => $this->faker->dateTimeBetween('+1 days', '+1 month'),
            'quantPessoas' => $this->faker->numberBetween(2, 20),
            'quantEspera' => $this->faker->numberBetween(0, 5),
            'valor' => $this->faker->randomFloat(2, 0, 100),
            'modalidade' => $this->faker->randomElement(['futebol', 'vôlei', 'basquete', 'tênis']),
            'tipo' => $this->faker->randomElement(['publica', 'privada']),
            'criador_id' => User::factory(),
            'local_id' => Local::factory(),
        ];
    }
}
