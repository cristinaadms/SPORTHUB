<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportHub - Minhas Partidas</title>
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
                <h1 class="text-xl font-bold text-gray-900">Minhas Partidas</h1>
                <button class="p-2 rounded-xl hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                </button>
            </div>

            <!-- Filtros -->
            <div class="flex space-x-2 mt-4">
                <button class="px-4 py-2 bg-blue-primary text-white rounded-xl text-sm font-medium">
                    Todas
                </button>
                <button
                    class="px-4 py-2 bg-gray-100 text-gray-600 rounded-xl text-sm font-medium hover:bg-gray-200 transition-colors">
                    Confirmadas
                </button>
                <button
                    class="px-4 py-2 bg-gray-100 text-gray-600 rounded-xl text-sm font-medium hover:bg-gray-200 transition-colors">
                    Pendentes
                </button>
                <button
                    class="px-4 py-2 bg-gray-100 text-gray-600 rounded-xl text-sm font-medium hover:bg-gray-200 transition-colors">
                    Passadas
                </button>
            </div>
        </div>
    </header>

    <!-- Conteúdo principal -->
    <main class="px-4 py-6 space-y-4">
        <!-- Partida confirmada -->
        <div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between mb-3">
                <div class="flex-1">
                    <div class="flex items-center space-x-2 mb-2">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Confirmado
                        </span>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-light text-blue-text">
                            Pública
                        </span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Futebol Society</h3>
                    <div class="space-y-1 text-sm text-gray-secondary">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Arena Sports Center
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Hoje, 19:00 - 21:00
                        </div>
                    </div>
                </div>
                <button onclick="window.location.href='{{ route('partidas.show', [1]) }}'"
                    class="bg-blue-primary hover:bg-blue-hover text-white px-4 py-2 rounded-xl font-semibold text-sm transition-colors">
                    Ver detalhes
                </button>
            </div>
        </div>

        <!-- Partida pendente -->
        <div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between mb-3">
                <div class="flex-1">
                    <div class="flex items-center space-x-2 mb-2">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            Pendente
                        </span>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                            Privada
                        </span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Tênis Duplas</h3>
                    <div class="space-y-1 text-sm text-gray-secondary">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Clube de Tênis
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Quinta, 18:00 - 20:00
                        </div>
                    </div>
                </div>
                <button class="bg-gray-400 text-white px-4 py-2 rounded-xl font-semibold text-sm">
                    Aguardando
                </button>
            </div>
        </div>

        <!-- Partida criada por mim -->
        <div
            class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition-shadow border-l-4 border-blue-primary">
            <div class="flex items-start justify-between mb-3">
                <div class="flex-1">
                    <div class="flex items-center space-x-2 mb-2">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            Organizador
                        </span>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-light text-blue-text">
                            Pública
                        </span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Basquete 3x3</h3>
                    <div class="space-y-1 text-sm text-gray-secondary">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Quadra do Parque
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Sábado, 15:00 - 17:00
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            4/6 participantes
                        </div>
                    </div>
                </div>
                <button
                    class="bg-blue-primary hover:bg-blue-hover text-white px-4 py-2 rounded-xl font-semibold text-sm transition-colors">
                    Gerenciar
                </button>
            </div>
        </div>

        <!-- Partida passada -->
        <div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition-shadow opacity-75">
            <div class="flex items-start justify-between mb-3">
                <div class="flex-1">
                    <div class="flex items-center space-x-2 mb-2">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                            Finalizada
                        </span>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-light text-blue-text">
                            Pública
                        </span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Vôlei de Praia</h3>
                    <div class="space-y-1 text-sm text-gray-secondary">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Praia de Copacabana
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Ontem, 08:00 - 10:00
                        </div>
                    </div>
                </div>
                <button class="bg-gray-200 text-gray-600 px-4 py-2 rounded-xl font-semibold text-sm">
                    Avaliar
                </button>
            </div>
        </div>
    </main>

    <!-- Menu inferior fixo -->
    <x-menu-inferior />
</body>

</html>
