@props([
    'title' => 'SportHub',
    'subtitle' => null,
    'backButton' => false,
    'searchBar' => false,
    'actionButton' => null
])

<header class="bg-white shadow-sm sticky top-0 z-40">
    <div class="px-4 py-4">
        <div class="flex items-center justify-between {{ $searchBar ? 'mb-4' : '' }}">
            @if($backButton)
                <button onclick="window.history.back()" class="p-2 rounded-xl hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            @endif

            <div class="flex items-center space-x-3 {{ $backButton ? '' : 'flex-1' }}">
                @if(!$backButton)
                    <div class="bg-blue-primary rounded-xl p-2">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                    </div>
                @endif
                <div>
                    <h1 class="text-xl font-bold text-gray-900">{{ $title }}</h1>
                    @if($subtitle)
                        <p class="text-sm text-gray-secondary">{{ $subtitle }}</p>
                    @endif
                </div>
            </div>

            @if($actionButton)
                {{ $actionButton }}
            @else
                @if(!$backButton)
                    <div class="w-10"></div>
                @endif
            @endif
        </div>

        @if($searchBar)
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" placeholder="Buscar partidas ou locais" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-primary focus:border-blue-primary sm:text-sm transition-colors">
            </div>
        @endif

        {{ $slot }}
    </div>
</header>