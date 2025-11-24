@props(['participantes' => collect(), 'partida'])

@php
    // Filtra apenas os confirmados
    $confirmados = $participantes->filter(fn($p) => $p['status'] === 'confirmado');

    $total = $confirmados->count();
    $vagas = 10 - $total;
@endphp

<div class="bg-white rounded-2xl shadow-md p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-gray-900">
            Participantes ({{ $total }})
        </h2>

        <span class="text-sm text-gray-secondary">
            {{ $vagas }} vagas restantes
        </span>
    </div>

    <div class="space-y-3">

        {{-- Confirmados --}}
        @foreach($confirmados as $p)
            <x-participante-item
                :nome="$p['nome']"
                :cargo="$p['cargo']"
                :cor="$p['cor']"
                :status="$p['status']"
                :organizador="$p['user_id'] === $partida->criador_id"
                :ehOrganizadorDaPartida="auth()->id() === $partida->criador_id"
                :userId="$p['user_id']"
                :partidaId="$partida->id"
            />
        @endforeach

        @if($participantes->where('status', 'pendente')->count() > 0 && $partida->criador_id === auth()->id())
            <hr class="my-4">

            <h3 class="text-md font-semibold text-gray-900 mb-2">
                Solicitações Pendentes ({{ $participantes->where('status', 'pendente')->count() }})
            </h3>

        @endif
        {{-- Pendentes (fora da contagem) --}}
        @foreach($participantes->where('status', 'pendente') as $p)
            <x-participante-item
                :nome="$p['nome']"
                :cargo="$p['cargo']"
                :cor="$p['cor']"
                :status="$p['status']"
                :organizador="$p['user_id'] === $partida->criador_id"
                :ehOrganizadorDaPartida="auth()->id() === $partida->criador_id"
                :userId="$p['user_id']"
                :partidaId="$partida->id"
            />
        @endforeach

    </div>
</div>