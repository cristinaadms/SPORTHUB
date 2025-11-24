<?php

namespace App\Http\Controllers;

use App\Models\Local;
use App\Models\Partida;
use App\Models\User;
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
        $user = Auth::user();

        // Inicia a query base para partidas futuras
        $query = Partida::with('local', 'criador')
        ->where('data', '>=', now());

        $raioAtual = null;

        // Se a URL tiver ?lat=-23.5&lon=-46.6
        if ($request->filled('lat') && $request->filled('lon')) {
            $raioAtual = $request->input('raio', 50);

            $query->proximoDe($request->lat, $request->lon, $raioAtual);
        } else {
            // Comportamento padrão: ordena por data
            $query->orderBy('data', 'asc');
        }

        // Pega os resultados (limitando a 10 para não carregar demais a home)
        $proximasPartidas = $query->limit(10)->get();

        // Carregar partidas em que o usuário participa
        $minhasPartidas = $user->partidas()
            ->with('local')
            ->where('data', '>=', now())
            ->orderBy('data', 'asc')
            ->get();

        return view('index', compact('proximasPartidas', 'minhasPartidas', 'raioAtual'));
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

        return redirect()->route('minhas-partidas')->with('success', 'Partida criada com sucesso!');
    }

    // public function show(Partida $partida)
    public function show(Partida $partida)
    {
        $userId = Auth::id();

        // Carregar o local com suas avaliações
        $partida->load(['local.avaliacoes']);

        if ($partida->criador_id === $userId) {
            $statusUsuario = 'organizador';
        } elseif ($partida->participantesConfirmados()->where('user_id', $userId)->exists()) {
            $statusUsuario = 'confirmado';
        } elseif ($partida->participantesEspera()->where('user_id', $userId)->exists()) {
            $statusUsuario = 'pendente';
        } else {
            $statusUsuario = 'disponivel';
        }

        return view('detalhes-partida', compact('partida', 'statusUsuario'));
    }

    public function edit(Partida $partida)
    {
        $locais = Local::all();

        return view('criar-partida', compact('partida', 'locais'));
    }

    public function update(Request $request, Partida $partida)
    {
        $dados = $this->validatePartida($request);

        $partida->update($dados);

        return redirect()->route('minhas-partidas')->with('success', 'Partida atualizada com sucesso!');
    }

    public function destroy(Partida $partida)
    {
        $partida->delete();

        return redirect()->route('minhas-partidas')->with('success', 'Partida removida com sucesso!');
    }

    public function chat(Partida $partida)
    {
        // Verificar se o usuário está participando da partida
        $user = Auth::user();

        $isParticipating = $partida->participantes()->where('user_id', $user->id)->exists()
                         || $partida->criador_id === $user->id;

        if (!$isParticipating) {
            return redirect()->route('partidas.show', $partida)
                           ->with('error', 'Você precisa estar participando da partida para acessar o chat.');
        }

        return view('chat-partida', compact('partida'));
    }

    // Métodos de interação com a partida

    public function entrar(Partida $partida)
    {
        $user = Auth::user();

        // Impede organizador de entrar (por segurança)
        if ($partida->criador_id === $user->id) {
            return back()->with('info', 'Você é o organizador desta partida!');
        }

        // Se o usuário que já participa
        if ($partida->participantes()->where('user_id', $user->id)->exists()) {
            return back()->with('info', 'Você já está nesta partida!');
        }

        // Verifica se a partida já atingiu o limite de pessoas confirmadas
        if ($partida->participantesConfirmados()->count() >= $partida->quantPessoas) {
            return back()->with('info', 'A partida já está cheia!');
        }

        // Se pública, entra direto
        if ($partida->tipo === 'publica') {
            $partida->participantes()->attach($user->id, ['status' => 'confirmado']);

            return back()->with('success', 'Você entrou na partida!');
        }

        // Se privada, envia solicitação
        $partida->participantes()->attach($user->id, ['status' => 'pendente']);

        return back()->with('info', 'Solicitação enviada ao organizador.');
    }

    public function sair(Partida $partida)
    {
        $user = Auth::user();

        // Impede o organizador de sair da partida (Precaução)
        // Obs.: possível erro em: criador_id
        if ($partida->criador_id === $user->id) {
            return back()->with('info', 'O organizador não pode sair da própria partida!');
        }

        $partida->participantes()->detach($user->id);

        return back()->with('success', 'Você saiu da partida.');
    }

    public function cancelarSolicitacao(Partida $partida)
    {
        $user = Auth::user();

        $partida->participantes()
            ->wherePivot('status', 'pendente')
            ->detach($user->id);

        return back()->with('info', 'Solicitação cancelada.');
    }
    public function aceitar(Partida $partida, User $user)
    {
        $partida->aceitarPedido($user->id);

        return back()->with('success', 'Participante aceito.');
    }

    public function recusar(Partida $partida, User $user)
{
    if (auth()->id() !== $partida->criador_id) {
        abort(403, 'Apenas o organizador pode fazer isso.');
    }

    $partida->participantes()->detach($user->id);

    return back()->with('success', 'Participante recusado.');
}

    public function expulsar(Partida $partida, User $user)
    {
        if (auth()->id() !== $partida->criador_id) {
            abort(403, 'Apenas o organizador pode fazer isso.');
        }

        $partida->participantes()->detach($user->id);

        return back()->with('success', 'Participante expulso da partida.');
    }

}
