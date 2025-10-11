@props(['nome', 'cargo' => '', 'cor' => 'blue', 'status' => null, 'organizador' => false])

<div
    class="flex items-center space-x-3 p-3 {{ $organizador ? 'bg-blue-light' : 'hover:bg-gray-50' }} rounded-xl transition-colors">
    <div class="relative">
        <div class="w-12 h-12 bg-{{ $cor }}-500 rounded-full flex items-center justify-center">
            <span class="text-white font-semibold text-lg">{{ strtoupper(substr($nome, 0, 1)) }}</span>
        </div>
        @if ($organizador)
            <div class="absolute -bottom-1 -right-1 bg-yellow-400 rounded-full p-1">
                <x-dynamic-component :component="'icons.star'" class="w-3 h-3 text-white" />
            </div>
        @endif
    </div>

    <div class="flex-1">
        <p class="font-semibold text-gray-900">{{ $nome }}</p>
        @if ($cargo)
            <p class="text-sm text-gray-secondary">{{ $cargo }}</p>
        @endif
    </div>

    @if ($status)
        <x-badge :text="$status" color="green" />
    @endif
</div>
