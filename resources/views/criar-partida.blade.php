<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportHub - Criar Partida</title>
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
            <div class="flex items-center justify-between">
                <button onclick="window.history.back()" class="p-2 rounded-xl hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <h1 class="text-xl font-bold text-gray-900">Criar Partida</h1>
                <div class="w-10"></div> <!-- Spacer -->
            </div>
        </div>
    </header>

    <!-- Formulário -->
    <main class="px-4 py-6">
        <form id="criarPartidaForm" class="space-y-6">
            <!-- Nome/Descrição da partida -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Informações da Partida</h2>

                <div class="space-y-4">
                    <div>
                        <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">
                            Nome da partida
                        </label>
                        <input type="text" id="nome" name="nome" required placeholder="Ex: Futebol Society"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-blue-primary transition-colors">
                    </div>

                    <div>
                        <label for="descricao" class="block text-sm font-medium text-gray-700 mb-2">
                            Descrição (opcional)
                        </label>
                        <textarea id="descricao" name="descricao" rows="3" placeholder="Descreva detalhes sobre a partida..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-blue-primary transition-colors resize-none"></textarea>
                    </div>
                </div>
            </div>

            <!-- Local -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Local</h2>

                <div>
                    <label for="local" class="block text-sm font-medium text-gray-700 mb-2">
                        Selecione o local
                    </label>
                    <select id="local" name="local" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-blue-primary transition-colors bg-white">
                        <option value="">Escolha um local</option>
                        <option value="arena-sports">Arena Sports Center</option>
                        <option value="quadra-parque">Quadra do Parque</option>
                        <option value="praia-copacabana">Praia de Copacabana</option>
                        <option value="clube-tenis">Clube de Tênis</option>
                        <option value="ginasio-municipal">Ginásio Municipal</option>
                        <option value="campo-universitario">Campo Universitário</option>
                    </select>
                </div>
            </div>

            <!-- Data e Horário -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Data e Horário</h2>

                <div class="space-y-4">
                    <div>
                        <label for="data" class="block text-sm font-medium text-gray-700 mb-2">
                            Data
                        </label>
                        <input type="date" id="data" name="data" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-blue-primary transition-colors">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="horario-inicio" class="block text-sm font-medium text-gray-700 mb-2">
                                Horário de início
                            </label>
                            <input type="time" id="horario-inicio" name="horario-inicio" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-blue-primary transition-colors">
                        </div>

                        <div>
                            <label for="horario-fim" class="block text-sm font-medium text-gray-700 mb-2">
                                Horário de fim
                            </label>
                            <input type="time" id="horario-fim" name="horario-fim" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-blue-primary transition-colors">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Configurações da Partida -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Configurações</h2>

                <div class="space-y-4">
                    <!-- Número máximo de participantes -->
                    <div>
                        <label for="max-participantes" class="block text-sm font-medium text-gray-700 mb-2">
                            Número máximo de participantes
                        </label>
                        <input type="number" id="max-participantes" name="max-participantes" min="2"
                            max="50" value="10" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-blue-primary transition-colors">
                    </div>

                    <!-- Toggle Pública/Privada -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Tipo de partida
                        </label>
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="tipo" value="publica" checked class="sr-only peer">
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-primary">
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-700">Pública</span>
                            </label>
                        </div>
                        <div class="mt-2 text-sm text-gray-secondary">
                            <span id="tipo-descricao">Qualquer pessoa pode se inscrever na partida</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botão Criar Partida -->
            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-blue-primary hover:bg-blue-hover text-white font-semibold py-4 px-6 rounded-2xl transition-all duration-200 shadow-md hover:shadow-lg">
                    Criar Partida
                </button>
            </div>
        </form>
    </main>

    <x-menu-inferior />

    <script>
        // Toggle entre Pública e Privada
        const radioButtons = document.querySelectorAll('input[name="tipo"]');
        const tipoDescricao = document.getElementById('tipo-descricao');

        // Criar radio button para Privada
        const publicaLabel = document.querySelector('label:has(input[value="publica"])');
        const privadaLabel = document.createElement('label');
        privadaLabel.className = 'flex items-center cursor-pointer';
        privadaLabel.innerHTML = `
            <input type="radio" name="tipo" value="privada" class="sr-only peer">
            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-400"></div>
            <span class="ml-3 text-sm font-medium text-gray-700">Privada</span>
        `;

        publicaLabel.parentNode.appendChild(privadaLabel);

        // Atualizar descrição baseada na seleção
        document.addEventListener('change', function(e) {
            if (e.target.name === 'tipo') {
                if (e.target.value === 'publica') {
                    tipoDescricao.textContent = 'Qualquer pessoa pode se inscrever na partida';
                } else {
                    tipoDescricao.textContent = 'Apenas pessoas convidadas podem participar';
                }
            }
        });

        // Definir data mínima como hoje
        const hoje = new Date().toISOString().split('T')[0];
        document.getElementById('data').min = hoje;
        document.getElementById('data').value = hoje;

        // Validação do formulário
        document.getElementById('criarPartidaForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const horarioInicio = document.getElementById('horario-inicio').value;
            const horarioFim = document.getElementById('horario-fim').value;

            if (horarioInicio >= horarioFim) {
                alert('O horário de fim deve ser posterior ao horário de início!');
                return;
            }

            // Simular criação da partida
            alert('Partida criada com sucesso!');
            window.location.href = "{{ route('index') }}";
        });
    </script>
</body>

</html>
