<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'senha',
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

    // Relacionamentos
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

    // Métodos auxiliares
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function cadastrarUsuario($dados)
    {
        return self::create($dados);
    }

    public function editarDadosUsuario($dados)
    {
        return $this->update($dados);
    }

    public function atualizarDadosUsuario($dados)
    {
        return $this->update($dados);
    }

}