@extends('layouts.app')

@section('title', 'SportHub - Dashboard')

@section('content')

    <x-header :subtitle="'Olá, ' . explode(' ', Auth::user()->name)[0] . '!'" :searchBar="true">
        <x-slot:actionButton>
            <button class="p-2 rounded-xl bg-gray-100 hover:bg-gray-200 transition-colors">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM9 7H4l5-5v5z" />
                </svg>
            </button>
        </x-slot:actionButton>
    </x-header>

    <!-- Conteúdo principal -->
    <main class="px-4 py-6 space-y-8">
        <!-- Seção Próximas partidas -->
        <section>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Próximas partidas</h2>
                <a href="#" class="text-blue-primary text-sm font-medium hover:text-blue-hover transition-colors">Ver
                    todas</a>
            </div>

            <!-- Cards horizontais -->
            <div class="space-y-3">

                <x-partida-card tipo="publica" titulo="Futebol Society" local="Arena Sports Center" horario="Hoje, 19:00"
                    :vagas="2" status="disponivel" url="{{ route('partidas.show', [1]) }}" />

                <x-partida-card tipo="privada" titulo="Basquete 3x3" local="Quadra do Parque" horario="Amanhã, 16:30"
                    :vagas="1" status="disponivel" url="{{ route('partidas.show', [2]) }}" />

                <x-partida-card tipo="publica" titulo="Vôlei de Praia" local="Praia de Copacabana" horario="Sábado, 08:00"
                    :vagas="5" status="disponivel" url="{{ route('partidas.show', [4]) }}" />

            </div>
        </section>

        <!-- Seção Minhas partidas -->
        <section>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Minhas partidas</h2>
                <a href="#" class="text-blue-primary text-sm font-medium hover:text-blue-hover transition-colors">Ver
                    todas</a>
            </div>

            <!-- Cards verticais -->
            <div class="grid grid-cols-2 gap-3">

                <!-- Card 1 - Confirmado -->
                <x-partida-card-vertical status="confirmado" titulo="Futebol Society" local="Arena Sports"
                    horario="Hoje, 19:00" url="{{ route('partidas.show', [1]) }}" />

                <!-- Card 2 - Pendente -->
                <x-partida-card-vertical status="pendente" titulo="Tênis Duplas" local="Clube Tênis" horario="Quinta, 18:00"
                    url="{{ route('partidas.show', [2]) }}" />

            </div>
        </section>
    </main>
@endsection