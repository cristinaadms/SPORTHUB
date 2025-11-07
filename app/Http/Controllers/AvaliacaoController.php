<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Partida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvaliacaoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'partida_id' => 'required|exists:partidas,id',
            'estrelas' => 'required|integer|min:1|max:5'
        ]);

        $usuarioId = Auth::id();
        $partida = Partida::findOrFail($request->partida_id);

        // ✅ Verifica se a partida já aconteceu
        if (now()->lt($partida->data)) {
            return back()->with('error', 'Você só pode avaliar após a partida ter sido encerrada.');
        }

        // ✅ Verifica se o usuário realmente participou (status confirmado)
        $participou = $partida->participantes()
            ->where('users.id', $usuarioId)
            ->wherePivot('status', 'confirmado')
            ->exists();

        if (! $participou) {
            return back()->with('error', 'Você só pode avaliar se participou da partida.');
        }

        // ✅ Verifica se o usuário já avaliou este local nesta partida
        $jaAvaliou = Avaliacao::where('partida_id', $partida->id)
            ->where('avaliador_id', $usuarioId)
            ->where('tipo', 'local')
            ->exists();

        if ($jaAvaliou) {
            return back()->with('error', 'Você já avaliou este local.');
        }

        // ✅ Cria a avaliação (tipo: local)
        Avaliacao::create([
            'avaliador_id' => $usuarioId,
            'partida_id' => $partida->id,
            'local_id' => $partida->local_id,
            'estrelas' => $request->estrelas,
            'tipo' => 'local'
        ]);

        return back()->with('success', 'Avaliação enviada com sucesso!');
    }
}
