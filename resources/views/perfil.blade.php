@extends('layouts.app')

@section('title', 'SportHub - Perfil')

@section('content')

    <x-header title="Perfil">
        <x-slot:actionButton>
            <button class="p-2 rounded-xl hover:bg-gray-100 transition-colors">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>
        </x-slot:actionButton>
    </x-header>

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
                    <div class="flex items-center mt-2">
                        <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        <span class="text-sm font-medium text-gray-700">4.8</span>
                        <span class="text-sm text-gray-secondary ml-1">(24 avaliações)</span>
                    </div>
                </div>
                <button
                    class="bg-blue-primary hover:bg-blue-hover text-white px-4 py-2 rounded-xl font-semibold text-sm transition-colors">
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
            </div>
        </div>

        <!-- Menu de opções -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="divide-y divide-gray-200">
                <button class="w-full flex items-center justify-between p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="font-medium text-gray-900">Editar Perfil</span>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <button onclick="window.location.href='{{ route('login') }}'"
                    class="w-full flex items-center justify-between p-4 hover:bg-red-50 transition-colors text-red-600">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="font-medium">Sair</span>
                    </div>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </main>
@endsection
