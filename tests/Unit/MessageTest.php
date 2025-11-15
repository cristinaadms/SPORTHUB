<?php

namespace Tests\Unit;

use App\Models\Message;
use App\Models\Partida;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function deveCriarUmaMensagemComCamposValidos()
    {
        // Arrange
        $user = User::factory()->create();
        $partida = Partida::factory()->create();

        // Act
        $message = Message::create([
            'conteudo' => 'Olá, pessoal!',
            'user_id' => $user->id,
            'partida_id' => $partida->id,
        ]);

        // Assert
        $this->assertDatabaseHas('messages', [
            'conteudo' => 'Olá, pessoal!',
            'user_id' => $user->id,
            'partida_id' => $partida->id,
        ]);

        $this->assertInstanceOf(Message::class, $message);
        $this->assertEquals('Olá, pessoal!', $message->conteudo);
    }

    /** @test */
    public function deveRetornarOUsuarioRelacionado()
    {
        $user = User::factory()->create();
        $partida = Partida::factory()->create();

        $message = Message::factory()->create([
            'user_id' => $user->id,
            'partida_id' => $partida->id,
        ]);

        $this->assertInstanceOf(User::class, $message->user);
        $this->assertEquals($user->id, $message->user->id);
    }

    /** @test */
    public function deveRetornarAPartidaRelacionada()
    {
        $user = User::factory()->create();
        $partida = Partida::factory()->create();

        $message = Message::factory()->create([
            'user_id' => $user->id,
            'partida_id' => $partida->id,
        ]);

        $this->assertInstanceOf(Partida::class, $message->partida);
        $this->assertEquals($partida->id, $message->partida->id);
    }

    /** @test */
    public function naoDevePermitirCriarMensagemSemConteudo()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Message::factory()->create(['conteudo' => null]);
    }
}
