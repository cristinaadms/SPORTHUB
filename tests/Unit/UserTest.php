<?php

namespace Tests\Unit;

use App\Models\Avaliacao;
use App\Models\Local;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function usuarioPodeSerCadastradoComSenhaHash()
    {
        $dados = [
            'name' => 'Maria',
            'email' => 'maria@example.com',
            'telefone' => '999999999',
            'password' => '12345678',
            'nota' => 0,
            'role' => 'user',
        ];

        $usuario = (new User())->cadastrar($dados);

        $this->assertDatabaseHas('users', ['email' => 'maria@example.com']);
        $this->assertTrue(Hash::check('12345678', $usuario->password));
    }

    #[Test]
    public function usuarioPodeAtualizarDadosComNovaSenha()
    {
        $usuario = User::factory()->create([
            'password' => Hash::make('antiga123'),
        ]);

        $usuario->atualizarDados(['password' => 'nova123']);

        $this->assertTrue(Hash::check('nova123', $usuario->password));
    }

    #[Test]
    public function verificaSeUsuarioEhAdmin()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);

        $this->assertTrue($admin->isAdmin());
        $this->assertFalse($user->isAdmin());
    }

    #[Test]
    public function verificaSeUsuarioEhComum()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);

        $this->assertTrue($user->isUser());
        $this->assertFalse($admin->isUser());
    }

    #[Test]
    public function notaMediaEhCalculadaCorretamente()
    {
        $avaliador = User::factory()->create();
        $local = Local::factory()->create();

        Avaliacao::factory()->count(3)->create([
            'avaliador_id' => $avaliador->id,
            'local_id' => $local->id,
            'tipo' => 'local',
            'estrelas' => 4,
        ]);

        $local->refresh();

        $this->assertEquals(4.0, $local->nota_media);
    }

    #[Test]
    public function contadorDeAvaliacoesFunciona()
    {
        $avaliador = User::factory()->create();
        $local = Local::factory()->create();

        Avaliacao::factory()->count(2)->create([
            'avaliador_id' => $avaliador->id,
            'local_id' => $local->id,
            'tipo' => 'local',
        ]);

        $this->assertEquals(2, $local->avaliacoes()->count());
    }
}
