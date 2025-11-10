<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Partida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatMessageController extends Controller
{
    public function index(Partida $partida)
    {
        $this->authorizeAccess($partida);

        $messages = $partida->messages()
            ->with('user:id,name')
            ->orderBy('created_at')
            ->get()
            ->map(function ($m) {
                return [
                    'id' => $m->id,
                    'author' => $m->user->name,
                    'user_id' => $m->user_id,
                    'conteudo' => $m->conteudo,
                    'time' => $m->created_at->format('H:i'),
                    'is_own' => $m->user_id === Auth::id(),
                ];
            });

        return response()->json(['data' => $messages]);
    }

    public function store(Request $request, Partida $partida)
    {
        $this->authorizeAccess($partida);

        $dados = $request->validate([
            'conteudo' => 'required|string|max:2000',
        ]);

        $message = Message::create([
            'conteudo' => $dados['conteudo'],
            'user_id' => Auth::id(),
            'partida_id' => $partida->id,
        ]);

        $message->load('user:id,name');

        return response()->json([
            'id' => $message->id,
            'author' => $message->user->name,
            'user_id' => $message->user_id,
            'conteudo' => $message->conteudo,
            'time' => $message->created_at->format('H:i'),
            'is_own' => true,
        ], 201);
    }

    private function authorizeAccess(Partida $partida): void
    {
        $user = Auth::user();
        $isParticipating = $partida->participantes()->where('user_id', $user->id)->exists() || $partida->criador_id === $user->id;
        abort_unless($isParticipating, 403, 'Você não participa desta partida.');
    }
}
