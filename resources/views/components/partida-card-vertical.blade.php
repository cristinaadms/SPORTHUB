@props([
    'status' => 'confirmado', // confirmado, pendente, cancelado, finalizado
    'titulo' => '',
    'local' => '',
    'horario' => '',
    'url' => '#',
    'buttonText' => null,
    'buttonDisabled' => false
])

@php
    // Configuração de badges por status
    $statusConfig = [
        'confirmado' => ['text' => 'Confirmado', 'class' => 'bg-green-100 text-green-800'],
        'pendente' => ['text' => 'Pendente', 'class' => 'bg-yellow-100 text-yellow-800'],
        'cancelado' => ['text' => 'Cancelado', 'class' => 'bg-red-100 text-red-800'],
        'finalizado' => ['text' => 'Finalizado', 'class' => 'bg-gray-100 text-gray-600'],
        'aguardando' => ['text' => 'Aguardando', 'class' => 'bg-orange-100 text-orange-800'],
    ];

    $currentStatus = $statusConfig[$status] ?? $statusConfig['confirmado'];

    // Configuração do botão baseado no status
    $buttonConfig = [
        'confirmado' => ['text' => 'Ver detalhes', 'class' => 'bg-blue-primary hover:bg-blue-hover text-white'],
        'pendente' => ['text' => 'Aguardando', 'class' => 'bg-gray-400 text-white cursor-not-allowed'],
        'cancelado' => ['text' => 'Ver detalhes', 'class' => 'bg-gray-300 hover:bg-gray-400 text-gray-700'],
        'finalizado' => ['text' => 'Ver detalhes', 'class' => 'bg-gray-200 hover:bg-gray-300 text-gray-700'],
    ];

    $currentButton = $buttonConfig[$status] ?? $buttonConfig['confirmado'];
    
    // Se buttonText foi fornecido, sobrescreve o texto padrão
    if ($buttonText) {
        $currentButton['text'] = $buttonText;
    }

    $isDisabled = $buttonDisabled || $status === 'pendente';
@endphp

<div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition-shadow">
    <!-- Badge de Status -->
    <div class="mb-3">
        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $currentStatus['class'] }}">
            {{ $currentStatus['text'] }}
        </span>
    </div>

    <!-- Título -->
    <h3 class="font-semibold text-gray-900 mb-2 text-sm">{{ $titulo }}</h3>

    <!-- Informações -->
    <div class="space-y-1 text-xs text-gray-secondary">
        <!-- Local -->
        <div class="flex items-center">
            <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="truncate">{{ $local }}</span>
        </div>

        <!-- Horário -->
        <div class="flex items-center">
            <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ $horario }}</span>
        </div>

        <!-- Slot para informações extras -->
        {{ $extraInfo ?? '' }}
    </div>

    <!-- Botão -->
    <button 
        @if(!$isDisabled)
            onclick="window.location.href='{{ $url }}'"
        @endif
        {{ $isDisabled ? 'disabled' : '' }}
        class="w-full mt-3 {{ $currentButton['class'] }} py-2 rounded-xl font-semibold text-xs transition-colors"
    >
        {{ $currentButton['text'] }}
    </button>
</div>