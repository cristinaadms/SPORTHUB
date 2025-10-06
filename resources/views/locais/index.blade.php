<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportHub - Locais</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'blue-primary': '#2563EB',
                        'blue-hover': '#1D4ED8',
                        'blue-light': '#EFF6FF',
                        'blue-text': '#1E40AF',
                        'gray-secondary': '#6B7280',
                        'gray-light': '#E5E7EB'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 pb-20">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-40">
        <div class="px-4 py-4">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="bg-green-600 rounded-xl p-2">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">Locais Esportivos</h1>
                        <p class="text-sm text-gray-secondary">
                            Encontre o local perfeito para sua partida
                        </p>
                    </div>
                </div>
                @if (Auth::user() && Auth::user()->isAdmin())
                    <div class="flex space-x-2">
                        <a href="{{ route('locais.create') }}"
                            class="bg-blue-primary hover:bg-blue-hover text-white px-4 py-2 rounded-xl font-semibold text-sm transition-colors shadow-sm">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Novo Local
                        </a>
                    </div>
                @endif
            </div>

            <!-- Barra de busca -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" id="buscarLocal" placeholder="Buscar locais por nome"
                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-primary focus:border-blue-primary sm:text-sm transition-colors">
            </div>
        </div>
    </header>

    <!-- Conteúdo principal -->
    <main class="px-4 py-6 space-y-6">
        <!-- Mensagens de sucesso/erro -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- Estatísticas -->
        <section>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-2xl shadow-md p-4">
                    <div class="flex items-center">
                        <div class="bg-blue-light rounded-xl p-3 mr-4">
                            <svg class="w-6 h-6 text-blue-primary" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-secondary">Total</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $locais->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-md p-4">
                    <div class="flex items-center">
                        <div class="bg-green-100 rounded-xl p-3 mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-secondary">Ativos</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $locais->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-md p-4 md:col-span-1 col-span-2">
                    <div class="flex items-center">
                        <div class="bg-purple-100 rounded-xl p-3 mr-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-secondary">Favoritos</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $locais->where('avaliacoes_count', '>', 0)->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Filtros -->
        <section>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Todos os Locais</h2>
                <div class="flex space-x-2">
                    <button onclick="filtrarLocais('todos')"
                        class="px-3 py-1 text-sm rounded-lg bg-blue-primary text-white filter-btn"
                        data-filter="todos">Todos</button>
                    <button onclick="filtrarLocais('com-foto')"
                        class="px-3 py-1 text-sm rounded-lg bg-gray-200 text-gray-600 hover:bg-gray-300 filter-btn"
                        data-filter="com-foto">Com Foto</button>
                    <button onclick="filtrarLocais('recentes')"
                        class="px-3 py-1 text-sm rounded-lg bg-gray-200 text-gray-600 hover:bg-gray-300 filter-btn"
                        data-filter="recentes">Recentes</button>
                </div>
            </div>
        </section>

        <!-- Lista de Locais -->
        <section>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="listaLocais">
                @forelse($locais as $local)
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow local-card"
                        data-nome="{{ strtolower($local->nome) }}"
                        data-tem-foto="{{ $local->imagem ? 'sim' : 'nao' }}"
                        data-criado="{{ $local->created_at->format('Y-m-d') }}">

                        <!-- Imagem ou placeholder -->
                        <div class="relative h-48 bg-gray-100 rounded-t-2xl overflow-hidden">
                            @if ($local->imagem)
                                <img src="data:image/jpeg;base64,{{ base64_encode($local->imagem) }}"
                                    alt="{{ $local->nome }}" class="w-full h-full object-cover">
                                <div class="absolute top-2 right-2">
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Com Foto
                                    </span>
                                </div>
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="absolute top-2 right-2">
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                        Sem Foto
                                    </span>
                                </div>
                            @endif

                            <!-- Status -->
                            <div class="absolute bottom-2 left-2">
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Ativo
                                </span>
                            </div>
                        </div>

                        <!-- Conteúdo do card -->
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2 text-lg">{{ $local->nome }}</h3>

                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-secondary">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                    <span class="font-mono text-xs">{{ $local->latitude }},
                                        {{ $local->longitude }}</span>
                                </div>

                                <div class="flex items-center text-sm text-gray-secondary">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Criado em {{ $local->created_at->format('d/m/Y') }}
                                </div>

                                @if ($local->partidas_count > 0)
                                    <div class="flex items-center text-sm text-gray-secondary">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $local->partidas_count }} partidas
                                    </div>
                                @endif
                            </div>

                            <!-- Avaliação (se existir) -->
                            @if ($local->nota_media > 0)
                                <div class="flex items-center mb-4">
                                    <div class="flex items-center mr-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-3 h-3 {{ $i <= $local->nota_media ? 'text-yellow-400' : 'text-gray-300' }}"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <span
                                        class="text-sm font-medium text-gray-600">{{ number_format($local->nota_media, 1) }}</span>
                                    <span class="text-sm text-gray-500 ml-1">({{ $local->avaliacoes_count }})</span>
                                </div>
                            @endif

                            <!-- Botões de ação -->
                            <div class="flex space-x-2">
                                <a href="{{ route('locais.show', $local->id) }}"
                                    class="flex-1 px-3 py-2 bg-blue-primary hover:bg-blue-hover text-white font-semibold text-sm rounded-lg transition-colors text-center">
                                    Ver Detalhes
                                </a>
                                @if (Auth::user() && Auth::user()->isAdmin())
                                    <a href="{{ route('locais.edit', $local->id) }}"
                                        class="px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold text-sm rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white rounded-2xl shadow-md p-8 text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhum local encontrado</h3>
                            <p class="text-gray-500 mb-6">Ainda não há locais cadastrados no sistema.</p>
                            @if (Auth::user() && Auth::user()->isAdmin())
                                <a href="{{ route('locais.create') }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-primary hover:bg-blue-hover text-white font-semibold rounded-xl transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    Criar Primeiro Local
                                </a>
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>
        </section>
    </main>

    <!-- Menu inferior fixo -->
    <x-menu-inferior />

    <script>
        // Função para filtrar locais
        function filtrarLocais(tipo) {
            const cards = document.querySelectorAll('.local-card');
            const buttons = document.querySelectorAll('.filter-btn');

            // Atualizar botões ativos
            buttons.forEach(btn => {
                btn.classList.remove('bg-blue-primary', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-600', 'hover:bg-gray-300');
            });

            const activeBtn = document.querySelector(`[data-filter="${tipo}"]`);
            activeBtn.classList.remove('bg-gray-200', 'text-gray-600', 'hover:bg-gray-300');
            activeBtn.classList.add('bg-blue-primary', 'text-white');

            // Filtrar cards
            const hoje = new Date().toISOString().split('T')[0];
            const seteDiasAtras = new Date(Date.now() - 7 * 24 * 60 * 60 * 1000).toISOString().split('T')[0];

            cards.forEach(card => {
                let mostrar = false;

                switch (tipo) {
                    case 'todos':
                        mostrar = true;
                        break;
                    case 'com-foto':
                        mostrar = card.getAttribute('data-tem-foto') === 'sim';
                        break;
                    case 'recentes':
                        const dataCriacao = card.getAttribute('data-criado');
                        mostrar = dataCriacao >= seteDiasAtras;
                        break;
                }

                card.style.display = mostrar ? 'block' : 'none';
            });
        }

        // Função de busca
        document.getElementById('buscarLocal').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.local-card');

            cards.forEach(card => {
                const nome = card.getAttribute('data-nome');
                if (nome.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Auto-fechar mensagens após alguns segundos
        setTimeout(function() {
            const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>

</html>
