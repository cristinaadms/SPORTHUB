<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportHub - Administração</title>
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
                    <div class="bg-red-600 rounded-xl p-2">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1M11 7H13V13H11V7M11 15H13V17H11V15Z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">Administração</h1>
                        <p class="text-sm text-gray-secondary">
                            Olá, {{ explode(' ', Auth::user()->name)[0] }}! (Admin)
                        </p>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <button onclick="toggleModal('modalCriarLocal')" class="bg-blue-primary hover:bg-blue-hover text-white px-4 py-2 rounded-xl font-semibold text-sm transition-colors shadow-sm">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Novo Local
                    </button>
                </div>
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
    <main class="px-4 py-6 space-y-8">
        <!-- Mensagens de sucesso/erro -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl" role="alert">
                <div class="flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <p class="font-semibold mb-1">Por favor, corrija os seguintes erros:</p>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        <!-- Estatísticas -->
        <section>
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="bg-white rounded-2xl shadow-md p-4">
                    <div class="flex items-center">
                        <div class="bg-blue-light rounded-xl p-3 mr-4">
                            <svg class="w-6 h-6 text-blue-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-secondary">Total de Locais</p>
                            <p class="text-2xl font-bold text-gray-900" id="totalLocais">{{ $locais->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-md p-4">
                    <div class="flex items-center">
                        <div class="bg-green-100 rounded-xl p-3 mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-secondary">Locais Ativos</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $locais->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Lista de Locais -->
        <section>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Gerenciar Locais</h2>
                <div class="flex space-x-2">
                    <button onclick="filtrarLocais('todos')" class="px-3 py-1 text-sm rounded-lg bg-blue-primary text-white">Todos</button>
                    <button onclick="filtrarLocais('recentes')" class="px-3 py-1 text-sm rounded-lg bg-gray-200 text-gray-600 hover:bg-gray-300">Recentes</button>
                </div>
            </div>

            <!-- Lista de Cards dos Locais -->
            <div class="space-y-3" id="listaLocais">
                @forelse($locais as $local)
                <div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition-shadow local-card" data-nome="{{ strtolower($local->nome) }}">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Ativo
                                </span>
                                @if($local->imagem)
                                <span class="text-xs text-gray-secondary">Com foto</span>
                                @endif
                            </div>
                            <h3 class="font-semibold text-gray-900 mb-1">{{ $local->nome }}</h3>
                            <div class="flex items-center text-sm text-gray-secondary mb-1">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                Lat: {{ $local->latitude }}, Long: {{ $local->longitude }}
                            </div>
                            <div class="flex items-center text-sm text-gray-secondary">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Criado em {{ $local->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="flex flex-col space-y-2 ml-4">
                            <button onclick="editarLocal({{ $local->id }}, '{{ $local->nome }}', '{{ $local->latitude }}', '{{ $local->longitude }}')" 
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg font-semibold text-xs transition-colors shadow-sm">
                                <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Editar
                            </button>
                            <button onclick="confirmarExclusao({{ $local->id }}, '{{ $local->nome }}')" 
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg font-semibold text-xs transition-colors shadow-sm">
                                <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Excluir
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white rounded-2xl shadow-md p-8 text-center">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhum local cadastrado</h3>
                    <p class="text-gray-500 mb-4">Comece criando seu primeiro local esportivo.</p>
                    <button onclick="toggleModal('modalCriarLocal')" class="bg-blue-primary hover:bg-blue-hover text-white px-4 py-2 rounded-xl font-semibold text-sm transition-colors">
                        Criar primeiro local
                    </button>
                </div>
                @endforelse
            </div>
        </section>
    </main>

    <!-- Modal Criar Local -->
    <div id="modalCriarLocal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-900">Novo Local</h2>
                    <button onclick="toggleModal('modalCriarLocal')" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('locais.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">Nome do Local</label>
                        <input type="text" id="nome" name="nome" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent"
                            placeholder="Ex: Arena Sports Center">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                            <input type="text" id="latitude" name="latitude" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent"
                                placeholder="-23.550520">
                        </div>
                        <div>
                            <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                            <input type="text" id="longitude" name="longitude" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent"
                                placeholder="-46.633308">
                        </div>
                    </div>

                    <div>
                        <label for="imagem" class="block text-sm font-medium text-gray-700 mb-2">Imagem do Local</label>
                        <input type="file" id="imagem" name="imagem" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Máximo 2MB. Formatos: JPG, PNG, GIF</p>
                    </div>

                    <div class="flex space-x-3 pt-4">
                        <button type="button" onclick="toggleModal('modalCriarLocal')"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="flex-1 px-4 py-2 bg-blue-primary hover:bg-blue-hover text-white rounded-lg transition-colors">
                            Criar Local
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar Local -->
    <div id="modalEditarLocal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-900">Editar Local</h2>
                    <button onclick="toggleModal('modalEditarLocal')" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form id="formEditarLocal" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="edit_nome" class="block text-sm font-medium text-gray-700 mb-2">Nome do Local</label>
                        <input type="text" id="edit_nome" name="nome" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="edit_latitude" class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                            <input type="text" id="edit_latitude" name="latitude" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent">
                        </div>
                        <div>
                            <label for="edit_longitude" class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                            <input type="text" id="edit_longitude" name="longitude" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent">
                        </div>
                    </div>

                    <div>
                        <label for="edit_imagem" class="block text-sm font-medium text-gray-700 mb-2">Nova Imagem do Local</label>
                        <input type="file" id="edit_imagem" name="imagem" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Deixe em branco para manter a imagem atual</p>
                    </div>

                    <div class="flex space-x-3 pt-4">
                        <button type="button" onclick="toggleModal('modalEditarLocal')"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="flex-1 px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors">
                            Atualizar Local
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Confirmação Exclusão -->
    <div id="modalExcluir" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center justify-center mb-4">
                    <div class="bg-red-100 rounded-full p-3">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-xl font-bold text-gray-900 text-center mb-2">Confirmar Exclusão</h2>
                <p class="text-gray-600 text-center mb-6">Tem certeza que deseja excluir o local <span id="nomeLocalExcluir" class="font-semibold"></span>? Esta ação não pode ser desfeita.</p>
                
                <div class="flex space-x-3">
                    <button type="button" onclick="toggleModal('modalExcluir')"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Cancelar
                    </button>
                    <form id="formExcluir" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                            Excluir
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu inferior fixo -->
    <x-menu-inferior />

    <script>
        // Funções para controlar modais
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
        }

        // Função para editar local
        function editarLocal(id, nome, latitude, longitude) {
            document.getElementById('edit_nome').value = nome;
            document.getElementById('edit_latitude').value = latitude;
            document.getElementById('edit_longitude').value = longitude;
            document.getElementById('formEditarLocal').action = `/locais/${id}`;
            toggleModal('modalEditarLocal');
        }

        // Função para confirmar exclusão
        function confirmarExclusao(id, nome) {
            document.getElementById('nomeLocalExcluir').textContent = nome;
            document.getElementById('formExcluir').action = `/locais/${id}`;
            toggleModal('modalExcluir');
        }

        // Função para filtrar locais
        function filtrarLocais(tipo) {
            const cards = document.querySelectorAll('.local-card');
            const buttons = document.querySelectorAll('button[onclick^="filtrarLocais"]');
            
            // Atualizar botões ativos
            buttons.forEach(btn => {
                btn.classList.remove('bg-blue-primary', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-600', 'hover:bg-gray-300');
            });
            
            event.target.classList.remove('bg-gray-200', 'text-gray-600', 'hover:bg-gray-300');
            event.target.classList.add('bg-blue-primary', 'text-white');
            
            // Filtrar cards (por enquanto mostra todos, pode implementar lógica específica)
            cards.forEach(card => {
                card.style.display = 'block';
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

        // Fechar modal clicando fora dele
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('fixed') && e.target.classList.contains('inset-0')) {
                e.target.classList.add('hidden');
            }
        });

        // Auto-fechar mensagens de sucesso após 5 segundos
        setTimeout(function() {
            const successAlert = document.querySelector('.bg-green-100');
            if (successAlert) {
                successAlert.style.transition = 'opacity 0.5s';
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.remove(), 500);
            }
        }, 5000);
    </script>
</body>

</html>