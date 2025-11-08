<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'telefone',
        'password',
        'nota',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'nota' => 'float',
    ];

    /* ==========================
       CRUD / Métodos auxiliares
    ===========================*/

    public function cadastrar(array $dados)
    {
        $dados['password'] = Hash::make($dados['password']);

        return self::create($dados);
    }

    public function atualizarDados(array $dados)
    {
        if (isset($dados['password'])) {
            $dados['password'] = Hash::make($dados['password']);
        }

        return $this->update($dados);
    }

    public static function login($email, $password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return Auth::user();
        }

        return null;
    }

    public static function logout()
    {
        Auth::logout();
    }

    public static function recuperarSenha($email)
    {
        return Password::sendResetLink(['email' => $email]);
    }

    /* ==========================
       Relacionamentos
    ===========================*/

    public function partidasCriadas()
    {
        return $this->hasMany(Partida::class, 'criador_id');
    }

    public function partidas()
    {
        return $this->belongsToMany(Partida::class, 'partida_user')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function avaliacoesFeitas()
    {
        return $this->hasMany(Avaliacao::class, 'avaliador_id');
    }

    public function avaliacoesRecebidas()
    {
        return $this->hasMany(Avaliacao::class, 'avaliado_id');
    }

    /* ==========================
       Accessors / Atributos dinâmicos
    ===========================*/

    // Retorna a nota média do usuário
    public function getNotaAttribute()
    {
        return round($this->avaliacoesRecebidas()->avg('estrelas') ?? 0, 1);
    }

    // Retorna o número de avaliações recebidas
    public function getAvaliacoesCountAttribute()
    {
        return $this->avaliacoesRecebidas()->count();
    }

    /* ==========================
       Verificações
    ===========================*/

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }
}
