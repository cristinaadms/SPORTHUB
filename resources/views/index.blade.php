<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportHub - Dashboard</title>
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
    <!-- Header com barra de busca -->
    <header class="bg-white shadow-sm sticky top-0 z-40">
        <div class="px-4 py-4">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-primary rounded-xl p-2">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">SportHub</h1>
                        <p class="text-sm text-gray-secondary">Olá, João!</p>
                    </div>
                </div>
                <button class="p-2 rounded-xl bg-gray-100 hover:bg-gray-200 transition-colors">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM9 7H4l5-5v5z"/>
                    </svg>
                </button>
            </div>
            
            <!-- Barra de busca -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" placeholder="Buscar partidas ou locais" 
                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-primary focus:border-blue-primary sm:text-sm transition-colors">
            </div>
        </div>
    </header>

    <!-- Conteúdo principal -->
    <main class="px-4 py-6 space-y-8">
        <!-- Seção Próximas partidas -->
        <section>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Próximas partidas</h2>
                <a href="#" class="text-blue-primary text-sm font-medium hover:text-blue-hover transition-colors">Ver todas</a>
            </div>
            
            <!-- Cards horizontais -->
            <div class="space-y-3">
                <!-- Card 1 - Partida Pública -->
                <div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-light text-blue-text">
                                    Pública
                                </span>
                                <span class="text-xs text-gray-secondary">2 vagas</span>
                            </div>
                            <h3 class="font-semibold text-gray-900 mb-1">Futebol Society</h3>
                            <div class="flex items-center text-sm text-gray-secondary mb-1">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Arena Sports Center
                            </div>
                            <div class="flex items-center text-sm text-gray-secondary">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Hoje, 19:00
                            </div>
                        </div>
                        <button class="bg-blue-primary hover:bg-blue-hover text-white px-4 py-2 rounded-xl font-semibold text-sm transition-colors shadow-sm">
                            Entrar
                        </button>
                    </div>
                </div>

                <!-- Card 2 - Partida Privada -->
                <div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                    Privada
                                </span>
                                <span class="text-xs text-gray-secondary">1 vaga</span>
                            </div>
                            <h3 class="font-semibold text-gray-900 mb-1">Basquete 3x3</h3>
                            <div class="flex items-center text-sm text-gray-secondary mb-1">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Quadra do Parque
                            </div>
                            <div class="flex items-center text-sm text-gray-secondary">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Amanhã, 16:30
                            </div>
                        </div>
                        <button class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-xl font-semibold text-sm transition-colors shadow-sm">
                            Pedir acesso
                        </button>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-light text-blue-text">
                                    Pública
                                </span>
                                <span class="text-xs text-gray-secondary">5 vagas</span>
                            </div>
                            <h3 class="font-semibold text-gray-900 mb-1">Vôlei de Praia</h3>
                            <div class="flex items-center text-sm text-gray-secondary mb-1">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Praia de Copacabana
                            </div>
                            <div class="flex items-center text-sm text-gray-secondary">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Sábado, 08:00
                            </div>
                        </div>
                        <button class="bg-blue-primary hover:bg-blue-hover text-white px-4 py-2 rounded-xl font-semibold text-sm transition-colors shadow-sm">
                            Entrar
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Seção Minhas partidas -->
        <section>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Minhas partidas</h2>
                <a href="#" class="text-blue-primary text-sm font-medium hover:text-blue-hover transition-colors">Ver todas</a>
            </div>
            
            <!-- Cards verticais -->
            <div class="grid grid-cols-2 gap-3">
                <!-- Card 1 -->
                <div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition-shadow">
                    <div class="mb-3">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Confirmado
                        </span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2 text-sm">Futebol Society</h3>
                    <div class="space-y-1 text-xs text-gray-secondary">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Arena Sports
                        </div>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Hoje, 19:00
                        </div>
                    </div>
                    <button onclick="window.location.href='detalhes-partida.html'" class="w-full mt-3 bg-blue-primary hover:bg-blue-hover text-white py-2 rounded-xl font-semibold text-xs transition-colors">
                        Ver detalhes
                    </button>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition-shadow">
                    <div class="mb-3">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            Pendente
                        </span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2 text-sm">Tênis Duplas</h3>
                    <div class="space-y-1 text-xs text-gray-secondary">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Clube Tênis
                        </div>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Quinta, 18:00
                        </div>
                    </div>
                    <button class="w-full mt-3 bg-gray-400 text-white py-2 rounded-xl font-semibold text-xs">
                        Aguardando
                    </button>
                </div>
            </div>
        </section>
    </main>

    <!-- Menu inferior fixo -->
    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 px-4 py-2">
        <div class="flex justify-around">
            <button class="flex flex-col items-center py-2 px-3 text-blue-primary">
                <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
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

