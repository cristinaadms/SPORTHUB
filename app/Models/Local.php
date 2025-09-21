<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;

    protected $table = 'locais';

    protected $fillable = [
        'nome',
        'latitude',
        'longitude',
        'imagem',
    ];

    // Relacionamentos
    public function partidas()
    {
        return $this->hasMany(Partida::class);
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }

    // Métodos auxiliares
    public function cadastrarLocal($dados)
    {
        return self::create($dados);
    }

    public function editarLocal($dados)
    {
        return $this->update($dados);
    }

    public function removerLocal()
    {
        return $this->delete();
    }

    public function getNotaMediaAttribute()
    {
        return $this->avaliacoes()->where('tipo', 'local')->avg('estrelas') ?: 0;
    }
}