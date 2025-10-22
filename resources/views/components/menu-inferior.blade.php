<nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 px-4 py-2">
    <div class="flex justify-around">
        <a href="{{ route('index') }}"
            class="flex flex-col items-center py-2 px-3 {{ request()->routeIs('index') ? 'text-blue-primary' : 'text-gray-400 hover:text-blue-primary' }}">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="text-xs font-medium">Home</span>
        </a>

        <a href="{{ route('minhas-partidas', ['minhas' => 1]) }}"
            class="flex flex-col items-center py-2 px-3 {{ request()->routeIs('minhas-partidas') ? 'text-blue-primary' : 'text-gray-400 hover:text-blue-primary' }}">
            <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <span class="text-xs font-medium">Partidas</span>
        </a>

        <a href="{{ route('partidas.create') }}"
            class="flex flex-col items-center py-2 px-3 {{ request()->routeIs('partidas.create') ? 'text-blue-primary' : 'text-gray-400 hover:text-blue-primary' }}">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span class="text-xs font-medium">Criar Partida</span>
        </a>

        <a href="{{ route('local.index') }}"
            class="flex flex-col items-center py-2 px-3 {{ request()->routeIs('locais.index') || request()->routeIs('locais.show') ? 'text-green-600' : 'text-gray-400 hover:text-green-600' }}">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="text-xs font-medium">Locais</span>
        </a>

        @if (Auth::user() && Auth::user()->isAdmin())
            <!--
            <a href="{{ route('admin.index') }}"
            class="flex flex-col items-center py-2 px-3 {{ request()->routeIs('admin.index') ? 'text-red-600' : 'text-gray-400 hover:text-red-600' }}">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4" />
            </svg>
            <span class="text-xs font-medium">Admin</span>
            </a>
            -->

            <a href="{{ route('local.create') }}"
                class="flex flex-col items-center py-2 px-3 {{ request()->routeIs('locais.create') ? 'text-blue-primary' : 'text-gray-400 hover:text-blue-primary' }}">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="text-xs font-medium">Criar Local</span>
            </a>
        @endif

        <a href="{{ route('perfil') }}"
            class="flex flex-col items-center py-2 px-3 {{ request()->routeIs('perfil') ? 'text-blue-primary' : 'text-gray-400 hover:text-blue-primary' }}">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="text-xs font-medium">Perfil</span>
        </a>
    </div>
</nav>
