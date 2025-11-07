@props(['partida', 'statusUsuario', 'ehOrganizador' => false])

@php
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Auth;

    $dataPartida = Carbon::parse($partida->data);
    $partidaEncerrada = $dataPartida->isPast();
    $usuario = Auth::user();

    // true se NÃO avaliou ainda
    $naoAvaliou = $partida->avaliacoes
        ->where('avaliador_id', $usuario->id)
        ->isEmpty();
@endphp

<div class="space-y-3">
    <!-- Botão de chat -->
    <a href="{{ route('partidas.chat', $partida) }}"
        class="w-full bg-blue-primary hover:bg-blue-hover text-white font-semibold py-4 px-6 rounded-2xl transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center space-x-2">
        <x-dynamic-component :component="'icons.chat'" class="w-5 h-5" />
        <span>Chat da Partida</span>
    </a>

    <div class="grid grid-cols-2 gap-3">
        <!-- botão de compartilhar (mantém visibilidade quando quiser) -->
        <button
            class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-4 rounded-xl transition-colors flex items-center justify-center space-x-2">
            <x-dynamic-component :component="'icons.share'" class="w-5 h-5" />
            <span>Compartilhar</span>
        </button>

        {{-- ORGANIZADOR --}}
        @if ($ehOrganizador)
            <button
                disabled
                class="bg-gray-100 text-gray-400 font-semibold py-3 px-4 rounded-xl cursor-not-allowed flex items-center justify-center space-x-2">
                <x-dynamic-component :component="'icons.users'" class="w-5 h-5" />
                <span>Organizador</span>
            </button>

        {{-- USUÁRIO DISPONÍVEL --}}
        @elseif ($statusUsuario === 'disponivel')
            @if ($partida->tipo === 'publica')
                <form action="{{ route('partidas.entrar', $partida->id) }}" method="POST" class="col-span-2">
                    @csrf 
                    <button type="submit"
                        class="w-full py-3 bg-blue-primary text-white font-semibold rounded-xl hover:bg-blue-hover transition-colors">
                        Entrar na Partida
                    </button> 
                </form> 
            @else
                <form action="{{ route('partidas.entrar', $partida->id) }}" method="POST" class="col-span-2">
                    @csrf 
                    <button type="submit"
                        class="w-full py-3 bg-blue-primary text-white font-semibold rounded-xl hover:bg-blue-hover transition-colors">
                        Solicitar acesso 
                    </button> 
                </form>
            @endif

        {{-- SOLICITAÇÃO PENDENTE --}}
        @elseif ($statusUsuario === 'pendente')
            <form action="{{ route('partidas.cancelar', $partida->id) }}" method="POST" class="col-span-2">
                @csrf 
                <button type="submit"
                    class="w-full py-3 bg-gray-400 text-white font-semibold rounded-xl hover:bg-gray-500 transition-colors">
                    Cancelar Solicitação 
                </button> 
            </form>

        {{-- CONFIRMADO --}}
        @elseif ($statusUsuario === 'confirmado')
            {{-- Se já passou e não avaliou → mostramos o botão "Avaliar" (no lugar do Sair? NÃO, mostramos adicionalmente) --}}
            @if ($partidaEncerrada && $naoAvaliou)
                {{-- Mantemos o botão Sair e também mostramos o botão Avaliar abaixo; para manter layout, colocamos Avaliar em col-span-2 --}}
                <form action="{{ route('partidas.sair', $partida->id) }}" method="POST" class="col-span-2">
                    @csrf 
                    <button type="submit"
                        class="w-full py-3 bg-red-500 text-white font-semibold rounded-xl hover:bg-red-600 transition-colors">
                        Sair da Partida 
                    </button> 
                </form>

                {{-- Botão que abre o modal --}}
                <button
                    onclick="window.dispatchEvent(new CustomEvent('abrir-modal-avaliar'))"
                    class="w-full py-3 bg-yellow-500 text-white font-semibold rounded-xl hover:bg-yellow-600 transition-colors flex items-center justify-center gap-2">
                    Avaliar Partida
                </button>

            @else

            @endif
        @endif
    </div>

    {{-- Modal de avaliação --}}
    @if ($statusUsuario === 'confirmado' && $partidaEncerrada && $naoAvaliou && ! $ehOrganizador)
        <div x-data="{ open: false, rating: 0 }"
            x-cloak
            x-init="
                window.addEventListener('abrir-modal-avaliar', () => { open = true; });
                window.addEventListener('fechar-modal-avaliar', () => { open = false; });
            ">
            <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center">
                <div class="fixed inset-0 bg-black/40 transition-opacity" @click="open = false"></div>

                <div class="bg-white w-11/12 max-w-md rounded-2xl shadow-lg p-6 z-50">
                    <h3 class="text-lg font-semibold text-center mb-4">Avaliar Local da Partida</h3>

                    <form method="POST" action="{{ route('avaliacoes.store') }}">
                        @csrf
                        <input type="hidden" name="partida_id" value="{{ $partida->id }}">

                        <!-- Estrelas -->
                        <div class="flex justify-center space-x-2 mb-4">
                            <template x-for="i in 5" :key="i">
                                <button type="button" @click="rating = i; $refs.input.value = i"
                                    :class="rating >= i ? 'text-yellow-400' : 'text-gray-300'"
                                    class="text-3xl transition">
                                    ★
                                </button>
                            </template>
                        </div>

                        <input x-ref="input" type="hidden" name="estrelas" required>

                        <button type="submit"
                            class="w-full py-3 bg-blue-primary text-white rounded-xl hover:bg-blue-hover font-semibold"
                            @click="$refs.input.value = rating">
                            Enviar Avaliação
                        </button>

                        <button type="button" @click="open = false"
                            class="w-full py-3 mt-2 bg-gray-200 rounded-xl">
                            Cancelar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif

</div>
