<?php

namespace Tests\Unit;

use App\Models\Avaliacao;
use App\Models\Local;
use App\Models\Partida;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AvaliacaoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function deveCriarUmaAvaliacaoValida()
    {
        $avaliador = User::factory()->create();
        $local = Local::factory()->create();
        $partida = Partida::factory()->create();

        $dados = [
            'estrelas' => 4.5,
            'feedback' => 'Excelente local!',
            'tipo' => 'local',
            'avaliador_id' => $avaliador->id,
            'local_id' => $local->id,
            'partida_id' => $partida->id,
        ];

        $avaliacao = Avaliacao::create($dados);

        $this->assertDatabaseHas('avaliacoes', [
            'avaliador_id' => $avaliador->id,
            'tipo' => 'local',
        ]);

        $this->assertEquals(4.5, $avaliacao->estrelas);
        $this->assertInstanceOf(Avaliacao::class, $avaliacao);
    }

    /** @test */
    public function deveCadastrarAvaliacaoUsandoMetodoPersonalizado()
    {
        $avaliador = User::factory()->create();
        $partida = Partida::factory()->create();

        $dados = [
            'estrelas' => 5,
            'feedback' => 'Usuário muito participativo.',
            'tipo' => 'local',
            'avaliador_id' => $avaliador->id,
            'partida_id' => $partida->id,
        ];

        $avaliacao = (new Avaliacao())->cadastrarAvaliacao($dados);

        $this->assertDatabaseHas('avaliacoes', [
            'avaliador_id' => $avaliador->id,
            'tipo' => 'local',
        ]);
    }

    /** @test */
    public function deveEditarUmaAvaliacao()
    {
        $avaliacao = Avaliacao::factory()->create(['feedback' => 'Bom local', 'estrelas' => 3]);

        $avaliacao->editarAvaliacao(['feedback' => 'Excelente local', 'estrelas' => 5]);

        $this->assertDatabaseHas('avaliacoes', [
            'id' => $avaliacao->id,
            'feedback' => 'Excelente local',
            'estrelas' => 5,
        ]);
    }

    /** @test */
    public function deveRemoverUmaAvaliacao()
    {
        $avaliacao = Avaliacao::factory()->create();

        $avaliacao->removerAvaliacao();

        $this->assertDatabaseMissing('avaliacoes', ['id' => $avaliacao->id]);
    }

    // /** @test */
    // public function deveIdentificarAvaliacaoDeUsuario()
    // {
    //     $avaliacao = Avaliacao::factory()->create(['tipo' => 'usuario']);

    //     $this->assertTrue($avaliacao->isAvaliacaoUsuario());
    //     $this->assertFalse($avaliacao->isAvaliacaoLocal());
    // }

    /** @test */
    public function deveIdentificarAvaliacaoDeLocal()
    {
        $avaliacao = Avaliacao::factory()->create(['tipo' => 'local']);

        $this->assertTrue($avaliacao->isAvaliacaoLocal());
        $this->assertFalse($avaliacao->isAvaliacaoUsuario());
    }

    /** @test */
    public function deveRetornarRelacionamentosCorretos()
    {
        $avaliador = User::factory()->create();
        $avaliado = User::factory()->create();
        $local = Local::factory()->create();
        $partida = Partida::factory()->create();

        $avaliacao = Avaliacao::factory()->create([
            'avaliador_id' => $avaliador->id,
            'avaliado_id' => $avaliado->id,
            'local_id' => $local->id,
            'partida_id' => $partida->id,
        ]);

        $this->assertInstanceOf(User::class, $avaliacao->avaliador);
        $this->assertInstanceOf(User::class, $avaliacao->avaliado);
        $this->assertInstanceOf(Local::class, $avaliacao->local);
        $this->assertInstanceOf(Partida::class, $avaliacao->partida);
    }
}
