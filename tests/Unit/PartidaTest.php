<?php

namespace Tests\Unit;

use App\Models\Local;
use App\Models\Partida;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PartidaTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function partidaPodeSerCriada()
    {
        $criador = User::factory()->create();
        $local = Local::factory()->create();

        $dados = [
            'nome' => 'Futebol da galera',
            'descricao' => 'Jogo amistoso entre amigos',
            'data' => now()->addDays(2),
            'quantPessoas' => 10,
            'quantEspera' => 2,
            'valor' => 15.50,
            'modalidade' => 'futebol',
            'tipo' => 'publica',
            'criador_id' => $criador->id,
            'local_id' => $local->id,
        ];

        $partida = (new Partida())->criarPartida($dados);

        $this->assertDatabaseHas('partidas', ['nome' => 'Futebol da galera']);
        $this->assertEquals('publica', $partida->tipo);
        $this->assertEquals($criador->id, $partida->criador_id);
    }

    #[Test]
    public function partidaPodeSerEditada()
    {
        $partida = Partida::factory()->create(['nome' => 'Antigo Nome']);

        $partida->editarPartida(['nome' => 'Novo Nome']);

        $this->assertEquals('Novo Nome', $partida->fresh()->nome);
    }

    #[Test]
    public function partidaPodeSerRemovida()
    {
        $partida = Partida::factory()->create();

        $partida->removerPartida();

        $this->assertDatabaseMissing('partidas', ['id' => $partida->id]);
    }

    #[Test]
    public function verificaSePartidaEhPublicaOuPrivada()
    {
        $publica = Partida::factory()->create(['tipo' => 'publica']);
        $privada = Partida::factory()->create(['tipo' => 'privada']);

        $this->assertTrue($publica->isPublica());
        $this->assertTrue($privada->isPrivada());
    }

    #[Test]
    public function verificaSePartidaTemVagas()
    {
        $partida = Partida::factory()->create(['quantPessoas' => 2]);
        $usuarios = User::factory()->count(2)->create();

        // adiciona apenas 1 confirmado
        $partida->participantes()->attach($usuarios[0]->id, ['status' => 'confirmado']);

        $this->assertTrue($partida->temVagas());

        // adiciona mais um confirmado
        $partida->participantes()->attach($usuarios[1]->id, ['status' => 'confirmado']);

        $this->assertFalse($partida->fresh()->temVagas());
    }

    #[Test]
    public function dataFormatadaEhGeradaCorretamente()
    {
        $data = Carbon::create(2025, 12, 25, 15, 30);
        $partida = Partida::factory()->create(['data' => $data]);

        $this->assertEquals('25/12/2025 15:30', $partida->getDataFormatada());
        $this->assertEquals('25/12/2025', $partida->getDiaFormatado());
        $this->assertEquals('15:30', $partida->getHoraFormatada());
    }

    #[Test]
    public function participantePodePedirEEntrarNaPartida()
    {
        $user = User::factory()->create();
        $partida = Partida::factory()->create();

        $partida->pedirEntrarPartida($user->id);

        $this->assertDatabaseHas('partida_user', [
            'user_id' => $user->id,
            'partida_id' => $partida->id,
            'status' => 'pendente',
        ]);
    }
}
