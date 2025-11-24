@extends('layouts.app')

@section('title', 'SportHub - Detalhes da Partida')

@section('content')
    <header class="bg-white shadow-sm sticky top-0 z-40">
        <div class="px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <button onclick="history.back()" class="p-2 rounded-xl bg-gray-100 hover:bg-gray-200 transition-colors">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">{{ $partida->nome }}</h1>
                        <p class="text-sm text-gray-secondary">Detalhes da partida</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Conteúdo principal -->
    <main class="px-4 py-6 space-y-6">
        <!-- Card principal da partida -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <x-partida-header :tipo="$partida->tipo" :status="$statusUsuario" :titulo="$partida->nome" :descricao="$partida->descricao" :organizador="$partida->criador->name" />

            <!-- Informações da partida -->
            <div class="p-6 space-y-4">
                <x-partida-info-grid :local="$partida->local->nome" :horario="$partida->getHoraFormatada()" :data="$partida->getDiaFormatado()" :participantes="$partida->participantesConfirmados()->count() . '/' . $partida->quantPessoas" />

                <!-- Avaliação do Local -->
                @php
                    $notaMedia = round($partida->local->nota_media, 1);
                    $totalAvaliacoes = $partida->local->avaliacoes()->where('tipo', 'local')->count();
                @endphp
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <h3 class="text-sm font-medium text-gray-700">Avaliação do Local</h3>
                        </div>
                        @if ($totalAvaliacoes > 0)
                            <div class="flex items-center gap-2">
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor($notaMedia))
                                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                        @elseif($i - 0.5 <= $notaMedia)
                                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <defs>
                                                    <linearGradient id="halfGrad{{ $i }}">
                                                        <stop offset="50%" stop-color="currentColor" />
                                                        <stop offset="50%" stop-color="#E5E7EB" />
                                                    </linearGradient>
                                                </defs>
                                                <path fill="url(#halfGrad{{ $i }})"
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-sm font-semibold text-gray-900">{{ number_format($notaMedia, 1) }}</span>
                                <span class="text-xs text-gray-500">({{ $totalAvaliacoes }}
                                    {{ $totalAvaliacoes == 1 ? 'avaliação' : 'avaliações' }})</span>
                            </div>
                        @else
                            <span class="text-sm text-gray-500 italic">Ainda não há nenhuma avaliação</span>
                        @endif
                    </div>
                </div>

                <x-descricao-card :descricao="$partida->descricao" />
            </div>
        </div>

        <x-participantes-list :partida="$partida" :participantes="$partida->participantes->map(function ($user) use ($partida) {
            return [
                'user_id' => $user->id,
                'nome' => $user->name,
                'cargo' => $user->id === auth()->id() ? 'Você' : null,
                'organizador' => $user->id === $partida->criador_id,
                'status' => $user->pivot->status,
                'cor' => $user->id === $partida->criador_id ? 'blue' : 'green',
            ];
        })" />


        <x-partida-actions :partida="$partida" :statusUsuario="$statusUsuario" :ehOrganizador="$partida->criador_id === Auth::id()" />
    </main>
@endsection
