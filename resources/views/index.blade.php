@extends('layouts.app')

@props(['tipo', 'titulo', 'local', 'horario', 'vagas' => null, 'status', 'url'])

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
                @forelse ($proximasPartidas as $partida)
                    <x-partida-card 
                        :tipo="$partida->tipo"
                        :titulo="$partida->modalidade"
                        :local="$partida->local->nome"
                        :horario="$partida->getDataFormatada()"
                        :vagas="$partida->quantPessoas - $partida->participantesConfirmados()->count()"
                        status="{{ $partida->temVagas() ? 'disponível' : 'lotado' }}" 
                        url="{{ route('partidas.show', $partida->id) }}" />

                @empty 
                    <p class="text-gray-500 text-sm">Nenhuma partida diponível no momento.</p>
                @endforelse
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
                @forelse($minhasPartidas as $partida)
                    <x-partida-card-vertical 
                        :status="$partida->pivot->status ?? 'pendente'" 
                        :titulo="$partida->modalidade" 
                        :local="$partida->local->nome"
                        :horario="$partida->getDataFormatada()" 
                        url="{{ route('partidas.show', $partida->id) }}" />
                @empty
                    <p class="text-gray-500 text-sm col-span-2">Você ainda não participa de nenhuma partida.</p>
                @endforelse
            </div> 
        </section>
    </main>
@endsection