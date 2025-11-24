@extends('layouts.app')

@section('title', 'SportHub - Minhas Partidas')

@section('content')
    <x-header title="Minhas Partidas" />

    <main class="px-4 py-6 space-y-4">
        @forelse ($partidas as $partida)
            <x-partida-card id="{{ $partida->id }}" tipo="{{ $partida->tipo }}"
                titulo="{{ $partida->nome ?? $partida->modalidade }}" local="{{ $partida->local->nome }}"
                horario="{{ $partida->getDataFormatada() }}"
                status="{{ $partida->participantesConfirmados()->where('user_id', Auth::id())->exists() ? 'confirmado' : 'pendente' }}"
                participantes="{{ $partida->participantesConfirmados()->count() }}/{{ $partida->quantPessoas }}"
                organizador="{{ $partida->criador_id === Auth::id() ? true : false }}"
                buttonAction="window.location.href='{{ route('partidas.show', $partida->id) }}'" />
        @empty
            <p class="text-gray-500">Você ainda não tem partidas criadas ou confirmadas.</p>
        @endforelse
    </main>
@endsection
