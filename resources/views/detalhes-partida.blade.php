<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportHub - Detalhes da Partida</title>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <h1 class="text-xl font-bold text-gray-900">Detalhes da Partida</h1>
                <button class="p-2 rounded-xl hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Conteúdo principal -->
    <main class="px-4 py-6 space-y-6">
        <!-- Card principal da partida -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <!-- Imagem de fundo -->
            <div class="h-48 bg-gradient-to-br from-blue-primary to-blue-hover relative">
                <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                <div class="absolute bottom-4 left-4 right-4">
                    <div class="flex items-center space-x-2 mb-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-light text-blue-text">
                            Pública
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            Confirmado
                        </span>
                    </div>
                    <h1 class="text-2xl font-bold text-white mb-1">Futebol Society</h1>
                    <p class="text-blue-100 text-sm">Partida amistosa entre amigos</p>
                </div>
            </div>

            <!-- Informações da partida -->
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-light p-2 rounded-xl">
                            <svg class="w-5 h-5 text-blue-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-secondary">Local</p>
                            <p class="font-semibold text-gray-900">Arena Sports Center</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-light p-2 rounded-xl">
                            <svg class="w-5 h-5 text-blue-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-secondary">Horário</p>
                            <p class="font-semibold text-gray-900">19:00 - 21:00</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-light p-2 rounded-xl">
                            <svg class="w-5 h-5 text-blue-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v8a1 1 0 01-1 1H5a1 1 0 01-1-1V8a1 1 0 011-1h3z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-secondary">Data</p>
                            <p class="font-semibold text-gray-900">Hoje</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-light p-2 rounded-xl">
                            <svg class="w-5 h-5 text-blue-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-secondary">Participantes</p>
                            <p class="font-semibold text-gray-900">8/10</p>
                        </div>
                    </div>
                </div>

                <!-- Descrição -->
                <div class="pt-4 border-t border-gray-200">
                    <h3 class="font-semibold text-gray-900 mb-2">Descrição</h3>
                    <p class="text-gray-secondary text-sm leading-relaxed">
                        Partida amistosa de futebol society. Venha se divertir e fazer novos amigos! 
                        Nível iniciante a intermediário. Chuteiras recomendadas.
                    </p>
                </div>
            </div>
        </div>

        <!-- Lista de participantes -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Participantes (8)</h2>
                <span class="text-sm text-gray-secondary">2 vagas restantes</span>
            </div>

            <div class="space-y-3">
                <!-- Organizador -->
                <div class="flex items-center space-x-3 p-3 bg-blue-light rounded-xl">
                    <div class="relative">
                        <div class="w-12 h-12 bg-blue-primary rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold text-lg">M</span>
                        </div>
                        <div class="absolute -bottom-1 -right-1 bg-yellow-400 rounded-full p-1">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-900">Marcos Silva</p>
                        <p class="text-sm text-blue-text">Organizador</p>
                    </div>
                </div>

                <!-- Participantes confirmados -->
                <div class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">J</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-900">João Santos</p>
                        <p class="text-sm text-gray-secondary">Você</p>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Confirmado
                    </span>
                </div>

                <div class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                    <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">A</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-900">Ana Costa</p>
                        <p class="text-sm text-gray-secondary">Meia</p>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Confirmado
                    </span>
                </div>

                <div class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">P</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-900">Pedro Lima</p>
                        <p class="text-sm text-gray-secondary">Atacante</p>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Confirmado
                    </span>
                </div>

                <div class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                    <div class="w-12 h-12 bg-indigo-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">C</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-900">Carlos Mendes</p>
                        <p class="text-sm text-gray-secondary">Zagueiro</p>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Confirmado
                    </span>
                </div>

                <div class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                    <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">L</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-900">Lucas Oliveira</p>
                        <p class="text-sm text-gray-secondary">Goleiro</p>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Confirmado
                    </span>
                </div>

                <div class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                    <div class="w-12 h-12 bg-pink-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">F</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-900">Fernanda Rocha</p>
                        <p class="text-sm text-gray-secondary">Lateral</p>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Confirmado
                    </span>
                </div>

                <div class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                    <div class="w-12 h-12 bg-teal-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">R</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-900">Rafael Souza</p>
                        <p class="text-sm text-gray-secondary">Volante</p>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Confirmado
                    </span>
                </div>
            </div>
        </div>

        <!-- Botões de ação -->
        <div class="space-y-3">
            <button class="w-full bg-blue-primary hover:bg-blue-hover text-white font-semibold py-4 px-6 rounded-2xl transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <span>Chat da Partida</span>
            </button>

            <div class="grid grid-cols-2 gap-3">
                <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-4 rounded-xl transition-colors flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                    </svg>
                    <span>Compartilhar</span>
                </button>

                <button class="bg-red-100 hover:bg-red-200 text-red-700 font-semibold py-3 px-4 rounded-xl transition-colors flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Sair</span>
                </button>
            </div>
        </div>
    </main>

    <!-- Menu inferior fixo -->
    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 px-4 py-2">
        <div class="flex justify-around">
            <button onclick="window.location.href='index.html'" class="flex flex-col items-center py-2 px-3 text-gray-400 hover:text-blue-primary transition-colors">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-xs font-medium">Home</span>
            </button>
            <button onclick="window.location.href='minhas-partidas.html'" class="flex flex-col items-center py-2 px-3 text-blue-primary">
                <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <span class="text-xs font-medium">Partidas</span>
            </button>
            <button onclick="window.location.href='criar-partida.html'" class="flex flex-col items-center py-2 px-3 text-gray-400 hover:text-blue-primary transition-colors">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="text-xs font-medium">Criar</span>
            </button>
            <button onclick="window.location.href='perfil.html'" class="flex flex-col items-center py-2 px-3 text-gray-400 hover:text-blue-primary transition-colors">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="text-xs font-medium">Perfil</span>
            </button>
        </div>
    </nav>
</body>
</html>

