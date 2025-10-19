<?php

namespace App\Http\Controllers;

use App\Models\Local;
use App\Models\Partida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartidaController extends Controller
{
    private function validatePartida(Request $request): array
    {
        $dados = $request->validate([
            'nome' => 'required|string',
            'descricao' => 'nullable|string',
            'data' => 'required|date',
            'quantPessoas' => 'required|integer|min:1',
            'quantEspera' => 'nullable|integer|min:0',
            'valor' => 'required|numeric|min:0',
            'modalidade' => 'required|string',
            'tipo' => 'required|in:publica,privada',
            'local_id' => 'required|exists:locais,id',
        ]);

        $dados['quantEspera'] = $dados['quantEspera'] ?? 0;

        return $dados;
    }

    // Lista de partidas já carregada no index
    public function index(Request $request)
    {
        // Exemplo: se existir o parâmetro "minhas" na query string
        if ($request->has('minhas') && $request->query('minhas') == '1') {
            // Futuramente aqui você pode filtrar as partidas do usuário logado
            return view('minhas-partidas');
        }

        $partidas = Partida::with('local', 'criador')->get();

        return view('index', compact('partidas'));
    }

    public function minhasPartidas()
    {
        $userId = Auth::id();

        $partidas = Partida::with('local', 'participantes')
                    ->where('criador_id', $userId)
                    ->orWhereHas('participantes', function ($query) use ($userId) {
                        $query->where('user_id', $userId);
                    })
                    ->orderBy('data', 'asc')
                    ->get();

        return view('minhas-partidas', compact('partidas'));
    }

    public function create()
    {
        $locais = Local::orderBy('nome')->get();

        return view('criar-partida', compact('locais'));
    }

    public function store(Request $request)
    {
        $dados = $this->validatePartida($request);

        $dados['criador_id'] = Auth::id();
        Partida::create($dados);

        return redirect()->route('index')->with('success', 'Partida criada com sucesso!');
    }

    // public function show(Partida $partida)
    public function show()
    {
        // $partida->load('participantes', 'local', 'criador');

        // return view('partidas.show', compact('partida'));
        return view('detalhes-partida');
    }

    public function edit(Partida $partida)
    {
        $locais = Local::all();

        return view('partidas.edit', compact('partida', 'locais'));
    }

    public function update(Request $request, Partida $partida)
    {
        $dados = $this->validatePartida($request);

        $partida->update($dados);

        return redirect()->route('index')->with('success', 'Partida atualizada com sucesso!');
    }

    public function destroy(Partida $partida)
    {
        $partida->delete();

        return redirect()->route('index')->with('success', 'Partida removida com sucesso!');
    }
}
