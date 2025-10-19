<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'data',
        'quantPessoas',
        'quantEspera',
        'valor',
        'modalidade',
        'tipo',
        'criador_id',
        'local_id',
    ];

    protected $casts = [
        'data' => 'datetime',
        'valor' => 'float',
    ];

    // Relacionamentos
    public function criador()
    {
        return $this->belongsTo(User::class, 'criador_id');
    }

    public function local()
    {
        return $this->belongsTo(Local::class);
    }

    public function participantes()
    {
        return $this->belongsToMany(User::class, 'partida_user')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function participantesConfirmados()
    {
        return $this->belongsToMany(User::class, 'partida_user')
                    ->wherePivot('status', 'confirmado')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function participantesEspera()
    {
        return $this->belongsToMany(User::class, 'partida_user')
                    ->wherePivot('status', 'espera')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }

    // Métodos auxiliares
    public function criarPartida($dados)
    {
        return self::create($dados);
    }

    public function editarPartida($dados)
    {
        return $this->update($dados);
    }

    public function removerPartida()
    {
        return $this->delete();
    }

    public function buscarPartida($filtros)
    {
        $query = self::query();

        if (isset($filtros['modalidade'])) {
            $query->where('modalidade', $filtros['modalidade']);
        }

        if (isset($filtros['data'])) {
            $query->whereDate('data', $filtros['data']);
        }

        if (isset($filtros['tipo'])) {
            $query->where('tipo', $filtros['tipo']);
        }

        return $query->get();
    }

    public function pedirEntrarPartida($userId)
    {
        return $this->participantes()->attach($userId, ['status' => 'pendente']);
    }

    public function aceitarPedido($userId)
    {
        $participantesConfirmados = $this->participantesConfirmados()->count();

        if ($participantesConfirmados < $this->quantPessoas) {
            return $this->participantes()->updateExistingPivot($userId, ['status' => 'confirmado']);
        } else {
            return $this->participantes()->updateExistingPivot($userId, ['status' => 'espera']);
        }
    }

    public function cancelarPedido($userId)
    {
        return $this->participantes()->detach($userId);
    }

    public function sairPartida($userId)
    {
        return $this->participantes()->detach($userId);
    }

    public function eliminarParticipante($userId)
    {
        return $this->participantes()->detach($userId);
    }

    public function isPublica()
    {
        return $this->tipo === 'publica';
    }

    public function isPrivada()
    {
        return $this->tipo === 'privada';
    }

    public function temVagas()
    {
        return $this->participantesConfirmados()->count() < $this->quantPessoas;
    }
}
