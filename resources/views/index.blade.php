@extends('layouts.app')

@props(['tipo', 'titulo', 'local', 'horario', 'vagas' => null, 'status', 'url'])

@php
    $filtroAtivo = request()->has('lat') && request()->has('lon') && request()->has('raio');
@endphp

@section('title', 'SportHub - Dashboard')

@section('content')

    <x-header :subtitle="'Olá, ' . explode(' ', Auth::user()->name)[0] . '!'" :searchBar="true">
        <x-slot:actionButton>
            <button onclick="buscarPartidasProximas()" title="Buscar partidas próximas a mim"
                class="p-2 rounded-xl bg-gray-100 hover:bg-gray-200 transition-colors group">

                <svg class="w-6 h-6 text-gray-600 group-hover:text-blue-primary" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>
        </x-slot:actionButton>
    </x-header>

    <!-- Conteúdo principal -->
    <main class="px-4 py-6 space-y-8">
        <!-- Seção Próximas partidas -->
        <section>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">
                    Próximas partidas
                    @if (isset($raioAtual))
                        <span class="text-sm font-normal text-gray-500 ml-2">
                            • Até {{ $raioAtual }} km
                        </span>
                    @endif
                </h2>

                <a href="#" id="toggleProximas" class="text-blue-primary text-sm font-medium hover:text-blue-hover transition-colors">Ver
                    todas</a>
            </div>

            <!-- Cards horizontais -->

            <div id="proximasList" class="space-y-3">
                @forelse ($proximasPartidas as $partida)
                    @php
                        // Verifica se o cálculo de distância existe neste objeto, formatando para "3,5 Km"
                        $distanciaFormatada = isset($partida->distancia)
                            ? number_format($partida->distancia, 1, ',', '.') . ' km'
                            : null;
                    @endphp
                    <x-partida-card :id="$partida->id" :tipo="$partida->tipo" :titulo="$partida->nome" :local="$partida->local->nome . ($distanciaFormatada ? ' • ' . $distanciaFormatada : '')"
                        :horario="$partida->getDataFormatada()" :vagas="$partida->quantPessoas - $partida->participantesConfirmados()->count()" status="{{ $partida->temVagas() ? 'disponível' : 'lotado' }}"
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
                <a href="{{ route('minhas-partidas') }}" class="text-blue-primary text-sm font-medium hover:text-blue-hover transition-colors">Ver
                    todas</a>
            </div>

            <!-- Cards verticais -->
            <div class="grid grid-cols-2 gap-3">
                @forelse($minhasPartidas as $partida)
                    <x-partida-card-vertical :status="$partida->pivot->status ?? 'pendente'" :titulo="$partida->nome"
                        :local="$partida->local->nome . ($distancia ? ' • ' . $distancia : '')":horario="$partida->getDataFormatada()"
                        url="{{ route('partidas.show', $partida->id) }}" />
                @empty
                    <p class="text-gray-500 text-sm col-span-2">Você ainda não participa de nenhuma partida.</p>
                @endforelse
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        const filtroAtivo = @json($filtroAtivo);

        function buscarPartidasProximas() {
            if (filtroAtivo) {
                // Vai para a home sem filtros
                window.location.href = `{{ route('index') }}`;
                return;
            }

            // Verifica se o navegador suporta geolocalização
            if (!navigator.geolocation) {
                alert("Seu navegador não suporta geolocalização.");
                return;
            }

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;

                    const raio = localStorage.getItem('sportHub_raio') || 50; // Padrão 50 se vazio

                    // envia tudo para o Laravel via URL
                    window.location.href = `{{ route('index') }}?lat=${lat}&lon=${lon}&raio=${raio}`;
                },
                (error) => {
                    console.error(error);
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            alert("Usuário negou a solicitação de Geolocalização.");
                            break;
                        default:
                            alert("Ocorreu um erro desconhecido ao buscar localização.");
                            break;
                    }
                }
            );
        }
    </script>
    <script>
        // Toggle para expandir/recolher a lista de próximas partidas
        document.addEventListener('DOMContentLoaded', function () {
            const maxShow = 3;
            const list = document.getElementById('proximasList');
            const toggleBtn = document.getElementById('toggleProximas');

            if (!list || !toggleBtn) return;

            const items = Array.from(list.querySelectorAll(':scope > *'));

            // Se não houver mais que o limite, esconde o botão
            if (items.length <= maxShow) {
                toggleBtn.style.display = 'none';
                return;
            }

            // estado inicial: recolhido
            toggleBtn.dataset.expanded = 'false';

            function updateView() {
                const expanded = toggleBtn.dataset.expanded === 'true';
                items.forEach((el, idx) => {
                    if (!expanded && idx >= maxShow) {
                        el.classList.add('hidden');
                    } else {
                        el.classList.remove('hidden');
                    }
                });
                toggleBtn.textContent = expanded ? 'Ver menos' : 'Ver todas';
            }

            updateView();

            toggleBtn.addEventListener('click', function (e) {
                e.preventDefault();
                toggleBtn.dataset.expanded = toggleBtn.dataset.expanded === 'true' ? 'false' : 'true';
                updateView();
                // rola para o topo da lista quando expande para melhorar UX
                if (toggleBtn.dataset.expanded === 'true') {
                    list.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
@endpush
