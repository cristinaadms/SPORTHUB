@extends('layouts.app')

@section('title', 'SportHub - {{ $local->nome }}')

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
                        <h1 class="text-xl font-bold text-gray-900">{{ $local->nome }}</h1>
                        <p class="text-sm text-gray-secondary">Detalhes do local</p>
                    </div>
                </div>
                @if (Auth::user() && Auth::user()->isAdmin())
                    <div class="flex space-x-2">
                        <a href="{{ route('local.edit', $local->id) }}"
                            class="p-2 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </header>

    <!-- Conteúdo principal -->
    <main class="px-4 py-6 space-y-6">
        <!-- Mensagens de sucesso/erro -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Imagem principal -->
        @if ($local->imagem)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="relative h-64 md:h-80">
                    <img src="data:image/jpeg;base64,{{ base64_encode($local->imagem) }}" alt="{{ $local->nome }}"
                        class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <h2 class="text-2xl font-bold text-white mb-2">{{ $local->nome }}</h2>
                        <div class="flex items-center text-white/90">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-sm">{{ $local->latitude }}, {{ $local->longitude }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-md">
                <div class="p-6">
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-primary rounded-xl p-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-gray-900 mb-1">{{ $local->nome }}</h2>
                            <div class="flex items-center text-gray-secondary">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-sm">{{ $local->latitude }}, {{ $local->longitude }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Informações do Local -->
        <div class="bg-white rounded-2xl shadow-md">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informações do Local</h3>

                <div class="space-y-4">
                    <!-- Nome -->
                    <div class="flex items-start space-x-3">
                        <div class="bg-blue-light rounded-lg p-2">
                            <svg class="w-5 h-5 text-blue-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-700">Nome</p>
                            <p class="text-gray-900">{{ $local->nome }}</p>
                        </div>
                    </div>

                    <!-- Coordenadas -->
                    <div class="flex items-start space-x-3">
                        <div class="bg-green-100 rounded-lg p-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-700">Coordenadas</p>
                            <p class="text-gray-900 font-mono text-sm">{{ $local->latitude }},
                                {{ $local->longitude }}</p>
                            <button onclick="abrirMapa()"
                                class="text-blue-primary text-sm hover:text-blue-hover transition-colors mt-1">
                                Ver no mapa →
                            </button>
                        </div>
                    </div>

                    <!-- Data de criação -->
                    <div class="flex items-start space-x-3">
                        <div class="bg-purple-100 rounded-lg p-2">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-700">Criado em</p>
                            <p class="text-gray-900">{{ $local->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    @if ($local->updated_at != $local->created_at)
                        <!-- Última atualização -->
                        <div class="flex items-start space-x-3">
                            <div class="bg-orange-100 rounded-lg p-2">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-700">Última atualização</p>
                                <p class="text-gray-900">{{ $local->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Partidas Relacionadas -->
        <div class="bg-white rounded-2xl shadow-md">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Partidas neste Local</h3>

                @if ($local->partidas && $local->partidas->count() > 0)
                    <div class="space-y-3">
                        @foreach ($local->partidas->take(5) as $partida)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex-1">
                                    <h4 class="font-medium text-gray-900">{{ $partida->tipo ?? 'Partida' }}</h4>
                                    <div class="flex items-center text-sm text-gray-secondary">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $partida->data ? \Carbon\Carbon::parse($partida->data)->format('d/m/Y') : 'Data não definida' }}
                                    </div>
                                </div>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $partida->status === 'ativa' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($partida->status ?? 'Pendente') }}
                                </span>
                            </div>
                        @endforeach

                        @if ($local->partidas->count() > 5)
                            <div class="text-center pt-2">
                                <button class="text-blue-primary text-sm hover:text-blue-hover transition-colors">
                                    Ver todas as {{ $local->partidas->count() }} partidas →
                                </button>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h4 class="text-lg font-medium text-gray-900 mb-2">Nenhuma partida encontrada</h4>
                        <p class="text-gray-500">Ainda não há partidas agendadas para este local.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Avaliações (se existir) -->
        @if ($local->avaliacoes && $local->avaliacoes->count() > 0)
            <div class="bg-white rounded-2xl shadow-md">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Avaliações</h3>
                        <div class="flex items-center space-x-2">
                            <div class="flex items-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $local->nota_media ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <span
                                class="text-sm font-medium text-gray-600">{{ number_format($local->nota_media, 1) }}</span>
                            <span class="text-sm text-gray-500">({{ $local->avaliacoes->count() }} avaliações)</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        @foreach ($local->avaliacoes->take(3) as $avaliacao)
                            <div class="border-l-4 border-blue-primary pl-4">
                                <div class="flex items-center space-x-2 mb-1">
                                    <div class="flex items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-3 h-3 {{ $i <= $avaliacao->estrelas ? 'text-yellow-400' : 'text-gray-300' }}"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <span
                                        class="text-xs text-gray-500">{{ $avaliacao->created_at->diffForHumans() }}</span>
                                </div>
                                @if ($avaliacao->comentario)
                                    <p class="text-sm text-gray-700">{{ $avaliacao->comentario }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Ações do Administrador -->
        @if (Auth::user() && Auth::user()->isAdmin())
            <div class="bg-white rounded-2xl shadow-md">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Ações do Administrador</h3>

                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('local.edit', $local->id) }}"
                            class="flex-1 px-4 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-xl transition-colors text-center">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Editar Local
                        </a>
                        <a href="{{ Auth::user()->isAdmin() ? route('admin.index') : route('local.index') }}"
                            class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors text-center">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            {{ Auth::user()->isAdmin() ? 'Gerenciar Locais' : 'Ver Todos os Locais' }}
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </main>

@endsection
@push('scripts')
    <script>
        // Abrir no Google Maps
        function abrirMapa() {
            const lat = '{{ $local->latitude }}';
            const lng = '{{ $local->longitude }}';
            const nome = '{{ $local->nome }}';

            const url =
                `https://www.google.com/maps/search/?api=1&query=${lat},${lng}&query_place_id=${encodeURIComponent(nome)}`;
            window.open(url, '_blank');
        }

        // Auto-fechar mensagens de sucesso após 5 segundos
        setTimeout(function() {
            const successAlert = document.querySelector('.bg-green-100');
            if (successAlert) {
                successAlert.style.transition = 'opacity 0.5s';
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.remove(), 500);
            }
        }, 5000);
    </script>
@endpush
