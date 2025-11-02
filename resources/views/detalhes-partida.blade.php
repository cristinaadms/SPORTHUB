@extends('layouts.app')

@section('title', 'SportHub - Detalhes da Partida')

@section('content')
    <x-header title="Detalhes da Partida" :backButton="true" />

    <!-- Conteúdo principal -->
    <main class="px-4 py-6 space-y-6">
        <!-- Card principal da partida -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <x-partida-header :tipo="$partida->tipo" :status="$statusUsuario" :titulo="$partida->nome" :descricao="$partida->descricao" :organizador="$partida->criador->name" />

            <!-- Informações da partida -->
            <div class="p-6 space-y-4">
                <x-partida-info-grid :local="$partida->local->nome" :horario="$partida->getHoraFormatada()" :data="$partida->getDiaFormatado()" :participantes="$partida->participantesConfirmados()->count() . '/' . $partida->quantPessoas" />

                <x-descricao-card :descricao="$partida->descricao" />
            </div>
        </div>

        <x-participantes-list :participantes="$partida->participantes->map(function ($user) use ($partida) {
            return [
                'nome' => $user->name,
                'cargo' => $user->id === auth()->id() ? 'Você' : null,
                'organizador' => $user->id === $partida->criador_id,
                'status' => $user->pivot->status,
                'cor' => $user->id === $partida->criador_id ? 'blue' : 'green',
            ];
        })" />

        <x-partida-actions 
            :partida="$partida"
            :statusUsuario="$statusUsuario"
            :ehOrganizador="$partida->criador_id === Auth::id()"
        />
    </main>
@endsection
