<?php

namespace Tests\Unit;

use App\Models\Avaliacao;
use App\Models\Local;
use App\Models\Partida;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function deveCriarUmLocalComDadosValidos()
    {
        $dados = [
            'nome' => 'Campo Central',
            'latitude' => -23.561684,
            'longitude' => -46.625378,
            'imagem' => 'imagem_teste.jpg',
        ];

        $local = Local::create($dados);

        $this->assertDatabaseHas('locais', ['nome' => 'Campo Central']);
        $this->assertInstanceOf(Local::class, $local);
        $this->assertEquals('Campo Central', $local->nome);
    }

    /** @test */
    public function deveCadastrarLocalUsandoMetodoPersonalizado()
    {
        $dados = [
            'nome' => 'Quadra Esportiva Norte',
            'latitude' => -22.9,
            'longitude' => -43.2,
            'imagem' => 'quadra.jpg',
        ];

        $local = (new Local())->cadastrarLocal($dados);

        $this->assertDatabaseHas('locais', ['nome' => 'Quadra Esportiva Norte']);
        $this->assertEquals(-43.2, $local->longitude);
    }

    /** @test */
    public function deveEditarUmLocalExistente()
    {
        $local = Local::factory()->create(['nome' => 'Antigo Nome']);

        $local->editarLocal(['nome' => 'Novo Nome']);

        $this->assertDatabaseHas('locais', ['nome' => 'Novo Nome']);
    }

    /** @test */
    public function deveRemoverUmLocal()
    {
        $local = Local::factory()->create();

        $local->removerLocal();

        $this->assertDatabaseMissing('locais', ['id' => $local->id]);
    }

    /** @test */
    public function deveRetornarPartidasRelacionadas()
    {
        $local = Local::factory()->create();
        $partida = Partida::factory()->create(['local_id' => $local->id]);

        $this->assertTrue($local->partidas->contains($partida));
    }

    /** @test */
    public function deveRetornarAvaliacoesRelacionadas()
    {
        $local = Local::factory()->create();
        $avaliacao = Avaliacao::factory()->create(['local_id' => $local->id, 'tipo' => 'local']);

        $this->assertTrue($local->avaliacoes->contains($avaliacao));
    }

    /** @test */
    public function deveRetornarMediaDasAvaliacoes()
    {
        $local = Local::factory()->create();

        Avaliacao::factory()->create(['local_id' => $local->id, 'estrelas' => 4, 'tipo' => 'local']);
        Avaliacao::factory()->create(['local_id' => $local->id, 'estrelas' => 2, 'tipo' => 'local']);

        $this->assertEquals(3.0, $local->nota_media);
    }

    /** @test */
    public function deveRetornarZeroQuandoNaoHouverAvaliacoes()
    {
        $local = Local::factory()->create();

        $this->assertEquals(0, $local->nota_media);
    }

    /** @test */
    public function deveConverterStreamParaStringNaImagem()
    {
        $local = new Local();

        $stream = fopen('php://memory', 'r+');
        fwrite($stream, 'imagem_em_stream');
        rewind($stream);

        $resultado = $local->getImagemAttribute($stream);

        $this->assertEquals('imagem_em_stream', $resultado);
    }
}
