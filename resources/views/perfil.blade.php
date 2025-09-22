<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportHub - Perfil</title>
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
                <h1 class="text-xl font-bold text-gray-900">Perfil</h1>
                <button class="p-2 rounded-xl hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Conteúdo principal -->
    <main class="px-4 py-6 space-y-6">
        <!-- Card do perfil -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <div class="flex items-center space-x-4 mb-6">
                <div class="w-20 h-20 bg-blue-primary rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-2xl">J</span>
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-bold text-gray-900">João Santos</h2>
                    <p class="text-gray-secondary">@joao.santos</p>
                    <div class="flex items-center mt-2">
                        <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                        <span class="text-sm font-medium text-gray-700">4.8</span>
                        <span class="text-sm text-gray-secondary ml-1">(24 avaliações)</span>
                    </div>
                </div>
                <button class="bg-blue-primary hover:bg-blue-hover text-white px-4 py-2 rounded-xl font-semibold text-sm transition-colors">
                    Editar
                </button>
            </div>

            <!-- Estatísticas -->
            <div class="grid grid-cols-3 gap-4 pt-4 border-t border-gray-200">
                <div class="text-center">
                    <p class="text-2xl font-bold text-blue-primary">47</p>
                    <p class="text-sm text-gray-secondary">Partidas</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-green-600">12</p>
                    <p class="text-sm text-gray-secondary">Organizadas</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-purple-600">156</p>
                    <p class="text-sm text-gray-secondary">Amigos</p>
                </div>
            </div>
        </div>

        <!-- Esportes favoritos -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Esportes Favoritos</h3>
            <div class="flex flex-wrap gap-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-light text-blue-text">
                    ⚽ Futebol
                </span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                    🏀 Basquete
                </span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    🏐 Vôlei
                </span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                    🎾 Tênis
                </span>
            </div>
        </div>

        <!-- Conquistas -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Conquistas</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center space-x-3 p-3 bg-yellow-50 rounded-xl">
                    <div class="w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Estreante</p>
                        <p class="text-xs text-gray-secondary">Primeira partida</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3 p-3 bg-blue-50 rounded-xl">
                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Sociável</p>
                        <p class="text-xs text-gray-secondary">10 partidas</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3 p-3 bg-green-50 rounded-xl">
                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Confiável</p>
                        <p class="text-xs text-gray-secondary">95% presença</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3 p-3 bg-purple-50 rounded-xl">
                    <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Organizador</p>
                        <p class="text-xs text-gray-secondary">5 partidas criadas</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu de opções -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="divide-y divide-gray-200">
                <button class="w-full flex items-center justify-between p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="font-medium text-gray-900">Editar Perfil</span>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <button class="w-full flex items-center justify-between p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="font-medium text-gray-900">Amigos</span>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <button class="w-full flex items-center justify-between p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span class="font-medium text-gray-900">Estatísticas</span>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <button class="w-full flex items-center justify-between p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="font-medium text-gray-900">Configurações</span>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <button onclick="window.location.href='login.html'" class="w-full flex items-center justify-between p-4 hover:bg-red-50 transition-colors text-red-600">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="font-medium">Sair</span>
                    </div>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
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
            <button onclick="window.location.href='minhas-partidas.html'" class="flex flex-col items-center py-2 px-3 text-gray-400 hover:text-blue-primary transition-colors">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <span class="text-xs font-medium">Partidas</span>
            </button>
            <button onclick="window.location.href='criar-partida.html'" class="flex flex-col items-center py-2 px-3 text-gray-400 hover:text-blue-primary transition-colors">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="text-xs font-medium">Criar</span>
            </button>
            <button class="flex flex-col items-center py-2 px-3 text-blue-primary">
                <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="text-xs font-medium">Perfil</span>
            </button>
        </div>
    </nav>
</body>
</html>

