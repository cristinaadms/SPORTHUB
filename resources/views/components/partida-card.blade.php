@props([
    'tipo' => 'publica',
    'titulo' => '',
    'local' => '',
    'horario' => '',
    'vagas' => 0,
    'url' => '#',
    'status' => 'disponivel', // disponivel, pendente, confirmado, lotado
    'buttonAction' => null, // Permite customizar a ação do botão
])

@php
    // Define o texto e estilo do botão baseado no tipo e status
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
    $isDisabled = in_array($status, ['lotado', 'pendente']);
@endphp

<div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition-shadow">
    <div class="flex items-center justify-between">
        <div class="flex-1">
            <div class="flex items-center space-x-2 mb-2">
                <span
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $tipo === 'publica' ? 'bg-blue-light text-blue-text' : 'bg-gray-100 text-gray-600' }}">
                    {{ ucfirst($tipo) }}
                </span>
                @if ($vagas > 0)
                    <span class="text-xs text-gray-secondary">{{ $vagas }}
                        {{ $vagas === 1 ? 'vaga' : 'vagas' }}</span>
                @elseif($vagas === 0 && $status !== 'lotado')
                    <span class="text-xs text-red-500">Últimas vagas!</span>
                @endif
            </div>
            <h3 class="font-semibold text-gray-900 mb-1">{{ $titulo }}</h3>
            <div class="flex items-center text-sm text-gray-secondary mb-1">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                {{ $local }}
            </div>
            <div class="flex items-center text-sm text-gray-secondary">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ $horario }}
            </div>
        </div>

        <button @if (!$isDisabled) onclick="{{ $buttonAction ?? "window.location.href='$url'" }}" @endif
            {{ $isDisabled ? 'disabled' : '' }}
            class="{{ $currentButton['class'] }} px-4 py-2 rounded-xl font-semibold text-sm transition-colors shadow-sm">
            {{ $currentButton['text'] }}
        </button>
    </div>
</div>
