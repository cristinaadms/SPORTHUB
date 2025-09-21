<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use HasFactory;

    protected $table = 'avaliacoes';

    protected $fillable = [
        'estrelas',
        'feedback',
        'tipo',
        'avaliador_id',
        'partida_id',
        'avaliado_id',
        'local_id',
    ];

    protected $casts = [
        'estrelas' => 'float',
    ];

    // Relacionamentos
    public function avaliador()
    {
        return $this->belongsTo(User::class, 'avaliador_id');
    }

    public function partida()
    {
        return $this->belongsTo(Partida::class);
    }

    public function avaliado()
    {
        return $this->belongsTo(User::class, 'avaliado_id');
    }

    public function local()
    {
        return $this->belongsTo(Local::class);
    }

    // Métodos auxiliares
    public function cadastrarAvaliacao($dados)
    {
        return self::create($dados);
    }

    public function editarAvaliacao($dados)
    {
        return $this->update($dados);
    }

    public function removerAvaliacao()
    {
        return $this->delete();
    }

    public function isAvaliacaoUsuario()
    {
        return $this->tipo === 'usuario';
    }

    public function isAvaliacaoLocal()
    {
        return $this->tipo === 'local';
    }
}