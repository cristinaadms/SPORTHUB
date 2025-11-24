@props(['participantes' => [], 'partida'])

<div class="bg-white rounded-2xl shadow-md p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-gray-900">Participantes ({{ count($participantes) }})</h2>
        <span class="text-sm text-gray-secondary">{{ 10 - count($participantes) }} vagas restantes</span>
    </div>

    <div class="space-y-3">
        @foreach($participantes as $p)
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
