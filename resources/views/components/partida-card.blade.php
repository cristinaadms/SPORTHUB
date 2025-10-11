@props([
    'tipo' => 'publica',
    'titulo' => '',
    'local' => '',
    'horario' => '',
    'participantes' => null, // ex: '4/6'
    'vagas' => 0,
    'url' => '#',
    'status' => 'disponivel', // disponivel, pendente, confirmado, lotado, finalizada
    'organizador' => false,
    'buttonAction' => null,
])

@php
    $buttonConfig = [
        'publica' => [
            'disponivel' => ['text' => 'Entrar', 'class' => 'bg-blue-primary hover:bg-blue-hover text-white'],
            'lotado' => ['text' => 'Lotado', 'class' => 'bg-gray-300 text-gray-600 cursor-not-allowed'],
            'confirmado' => ['text' => 'Ver detalhes', 'class' => 'bg-green-600 hover:bg-green-700 text-white'],
        ],
        'privada' => [
            'disponivel' => ['text' => 'Pedir acesso', 'class' => 'bg-gray-400 hover:bg-gray-500 text-white'],
            'pendente' => ['text' => 'Aguardando', 'class' => 'bg-yellow-500 text-white cursor-not-allowed'],
            'confirmado' => ['text' => 'Ver detalhes', 'class' => 'bg-green-600 hover:bg-green-700 text-white'],
        ],
    ];

    $currentButton = $buttonConfig[$tipo][$status] ?? [
        'text' => 'Ver detalhes',
        'class' => 'bg-blue-primary hover:bg-blue-hover text-white',
    ];

    $isDisabled = in_array($status, ['lotado', 'pendente', 'finalizada']);
@endphp

<div
    class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition-shadow
    {{ $organizador ? 'border-l-4 border-blue-primary' : '' }}
    {{ $status === 'finalizada' ? 'opacity-75' : '' }}">

    <div class="flex items-start justify-between">
        <div class="flex-1">
            <div class="flex items-center space-x-2 mb-2">
                <span
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                    {{ $organizador ? 'bg-blue-100 text-blue-800' : ($tipo === 'publica' ? 'bg-blue-light text-blue-text' : 'bg-gray-100 text-gray-600') }}">
                    {{ $organizador ? 'Organizador' : ucfirst($tipo) }}
                </span>
                @if ($participantes)
                    <span class="text-xs text-gray-secondary">{{ $participantes }} participantes</span>
                @elseif ($vagas > 0)
                    <span class="text-xs text-gray-secondary">{{ $vagas }}
                        {{ $vagas === 1 ? 'vaga' : 'vagas' }}</span>
                @elseif($vagas === 0 && $status !== 'lotado')
                    <span class="text-xs text-red-500">Últimas vagas!</span>
                @endif
            </div>

            <h3 class="font-semibold text-gray-900 mb-1">{{ $titulo }}</h3>

            <div class="space-y-1 text-sm text-gray-secondary">
                @if ($local)
                    <div class="flex items-center">
                        <x-info-item icon="local" :value="$local" />
                    </div>
                @endif
                @if ($horario)
                    <div class="flex items-center">
                        <x-info-item icon="clock" :value="$horario" />
                    </div>
                @endif
            </div>
        </div>

        <button @if (!$isDisabled) onclick="{{ $buttonAction ?? "window.location.href='$url'" }}" @endif
            {{ $isDisabled ? 'disabled' : '' }}
            class="{{ $currentButton['class'] }} px-4 py-2 rounded-xl font-semibold text-sm transition-colors shadow-sm">
            {{ $currentButton['text'] }}
        </button>
    </div>
</div>
