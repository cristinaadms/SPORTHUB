<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\Partida;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChatMessageTest extends TestCase
{
    use RefreshDatabase;

    private function createPartida(User $criador, int $localId): Partida
    {
        return Partida::create([
            'nome' => 'Jogo Teste',
            'descricao' => 'Desc',
            'data' => now()->addHour(),
            'quantPessoas' => 10,
            'quantEspera' => 0,
            'valor' => 0,
            'modalidade' => 'futebol',
            'tipo' => 'publica',
            'criador_id' => $criador->id,
            'local_id' => $localId,
        ]);
    }

    public function test_user_can_list_messages()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Minimal local dependency workaround: ensure a local exists
        $localId = \DB::table('locais')->insertGetId([
            'nome' => 'Local X',
            'latitude' => '-23.5',
            'longitude' => '-46.6',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $partida = $this->createPartida($user, $localId);

        Message::factory()->count(3)->create([
            'partida_id' => $partida->id,
            'user_id' => $user->id,
        ]);

        $resp = $this->getJson(route('partidas.chat.messages.index', $partida));
        $resp->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_user_can_send_message()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $localId = \DB::table('locais')->insertGetId([
            'nome' => 'Local X',
            'latitude' => '-23.5',
            'longitude' => '-46.6',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $partida = $this->createPartida($user, $localId);

        $resp = $this->postJson(route('partidas.chat.messages.store', $partida), [
            'conteudo' => 'Olá pessoal!',
        ]);

        $resp->assertCreated()->assertJsonFragment([
            'conteudo' => 'Olá pessoal!',
            'author' => $user->name,
        ]);

        $this->assertDatabaseHas('messages', [
            'conteudo' => 'Olá pessoal!',
            'partida_id' => $partida->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_non_participant_cannot_access_messages()
    {
        $criador = User::factory()->create();
        $intruso = User::factory()->create();
        $this->actingAs($intruso);

        $localId = \DB::table('locais')->insertGetId([
            'nome' => 'Local X',
            'latitude' => '-23.5',
            'longitude' => '-46.6',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $partida = $this->createPartida($criador, $localId);

        $resp = $this->getJson(route('partidas.chat.messages.index', $partida));
        $resp->assertStatus(403);
    }
}
