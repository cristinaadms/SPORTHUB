@props(['partida', 'statusUsuario', 'ehOrganizador' => false])

<div class="space-y-3">
    <!-- Botão de chat -->
    <button
        class="w-full bg-blue-primary hover:bg-blue-hover text-white font-semibold py-4 px-6 rounded-2xl transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center space-x-2">
        <x-dynamic-component :component="'icons.chat'" class="w-5 h-5" />
        <span>Chat da Partida</span>
    </button>

    <div class="grid grid-cols-2 gap-3">
        <!-- botão de compartilhar -->
        <button
            class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-4 rounded-xl transition-colors flex items-center justify-center space-x-2">
            <x-dynamic-component :component="'icons.share'" class="w-5 h-5" />
            <span>Compartilhar</span>
        </button>

        <!-- Condicionais -->
        @if ($ehOrganizador)
            <!-- Nenhum botão de interação aparece -->
             <button
                disabled
                class="bg-gray-100 text-gray-400 font-semibold py-3 px-4 rounded-xl cursor-not-allowed flex items-center justify-center space-x-2">
                <x-dynamic-component :component="'icons.users'" class="w-5 h-5" />
                <span>Organizador</span>
            </button>
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
                <form action="{{ route('partidas.entrar', $partida->id) }}" method="POST" clas="col-span-2">
                    @csrf 
                    <button type="submit"
                        class="w-full py-3 bg-blue-primary text-white font-semibold rounded-xl hover:bg-blue-hover transition-colors">
                        Solicitar acesso 
                    </button> 
                </form>
            @endif 
        
        @elseif ($statusUsuario === 'pendente')
            <form action="{{ route('partidas.cancelar', $partida->id) }}" method="POST" class="col-span-2">
                @csrf 
                <button type="submit"
                    class="w-full py-3 bg-gray-400 text-white font-semibold rounded-xl hover:bg-gray-500 transition-colors">
                    Cancelar Solicitação 
                </button> 
            </form>

        @elseif ($statusUsuario === 'confirmado')
            <form action="{{ route('partidas.sair', $partida->id) }}" method="POST" class="col-span-2">
                @csrf 
                <button type="submit"
                    class="w-full py-3 bg-red-500 text-white font-semibold rounded-xl hover:bg-red-600 transition-colors">
                    Sair da Partida 
                </button> 
            </form>
        @endif
    </div>
</div>
