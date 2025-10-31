@props(['partida'])

<div class="space-y-3">
    <a href="{{ route('partidas.chat', $partida) }}"
        class="w-full bg-blue-primary hover:bg-blue-hover text-white font-semibold py-4 px-6 rounded-2xl transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center space-x-2">
        <x-dynamic-component :component="'icons.chat'" class="w-5 h-5" />
        <span>Chat da Partida</span>
    </a>

    <div class="grid grid-cols-2 gap-3">
        <button
            class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-4 rounded-xl transition-colors flex items-center justify-center space-x-2">
            <x-dynamic-component :component="'icons.share'" class="w-5 h-5" />
            <span>Compartilhar</span>
        </button>

        <button
            class="bg-red-100 hover:bg-red-200 text-red-600 font-semibold py-3 px-4 rounded-xl transition-colors flex items-center justify-center space-x-2">
            <x-dynamic-component :component="'icons.exit'" class="w-5 h-5" />
            <span>Sair</span>
        </button>
    </div>
</div>
