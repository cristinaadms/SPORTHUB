@extends('layouts.app')

@section('title', 'SportHub - Minhas Partidas')

@section('content')
    <x-header title="Minhas Partidas">
        <!-- Slot para o botão de ação -->
        <x-slot name="actionButton">
            <button class="p-2 rounded-xl hover:bg-gray-100 transition-colors">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
            </button>
        </x-slot>

        <!-- Slot para os filtros -->
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
    </x-header>

    <!-- Conteúdo principal -->
    <main class="px-4 py-6 space-y-4">

        <!-- Partida confirmada -->
        <x-partida-card tipo="publica" titulo="Futebol Society" local="Arena Sports Center" horario="Hoje, 19:00 - 21:00"
            status="confirmado" url="{{ route('partidas.show', [1]) }}" />

        <!-- Partida pendente -->
        <x-partida-card tipo="privada" titulo="Tênis Duplas" local="Clube de Tênis" horario="Quinta, 18:00 - 20:00"
            status="pendente" />

        <!-- Partida criada por mim -->
        <x-partida-card tipo="publica" titulo="Basquete 3x3" local="Quadra do Parque" horario="Sábado, 15:00 - 17:00"
            status="disponivel" participantes="4/6" organizador="true"
            buttonAction="window.location.href='{{ route('partidas.show', [1]) }}'" />

        <!-- Partida passada -->
        <x-partida-card tipo="publica" titulo="Vôlei de Praia" local="Praia de Copacabana" horario="Ontem, 08:00 - 10:00"
            status="finalizada" buttonAction="window.location.href='{{ route('partidas.show', [1]) }}'" />
    </main>
@endsection
