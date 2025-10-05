<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Local;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Criar usuário administrador
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@sporthub.com',
            'telefone' => '11999999999',
            'role' => 'admin',
        ]);

        // Criar alguns locais de exemplo
        Local::create([
            'nome' => 'Arena Sports Center',
            'latitude' => '-23.550520',
            'longitude' => '-46.633308',
        ]);

        Local::create([
            'nome' => 'Quadra do Parque Ibirapuera',
            'latitude' => '-23.587416',
            'longitude' => '-46.657634',
        ]);

        Local::create([
            'nome' => 'Centro Esportivo Vila Olímpia',
            'latitude' => '-23.595501',
            'longitude' => '-46.686371',
        ]);

        Local::create([
            'nome' => 'Complexo Aquático Maria Lenk',
            'latitude' => '-23.007389',
            'longitude' => '-43.395668',
        ]);
    }
}
