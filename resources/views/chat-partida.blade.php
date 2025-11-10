@extends('layouts.app')

@section('title', 'SportHub - Chat da Partida')

@section('content')
    <x-header title="Chat" subtitle="{{ $partida->nome }}" :backButton="true">
        <x-slot:actionButton>
            <a href="{{ route('partidas.show', $partida) }}" class="p-2 rounded-xl bg-gray-100 hover:bg-gray-200 transition-colors" title="Detalhes da partida">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </a>
        </x-slot:actionButton>
    </x-header>

    <!-- Container principal do chat -->
    <div class="flex flex-col h-[calc(100vh-140px)]" x-data="chatPartida({
        messagesIndexUrl: '{{ route('partidas.chat.messages.index', $partida) }}',
        messagesStoreUrl: '{{ route('partidas.chat.messages.store', $partida) }}',
        csrfToken: '{{ csrf_token() }}',
        currentUserId: {{ auth()->id() }},
    })">
        
        <!-- Área de mensagens -->
        <div class="flex-1 overflow-y-auto px-4 py-4 space-y-4 bg-gray-50" x-ref="messagesContainer">
            <!-- Mensagem de sistema -->
            <x-system-message message="Chat da partida iniciado" />
            
            <!-- Lista de mensagens (dinâmica) -->
            <template x-for="m in messages" :key="m.id">
                <div>
                    <!-- Própria (direita) -->
                    <template x-if="m.is_own || m.user_id === currentUserId">
                        <div class="flex items-end space-x-2 justify-end mb-2">
                            <div class="flex-1 flex flex-col items-end">
                                <div class="bg-blue-primary rounded-2xl rounded-tr-md shadow-sm p-3 max-w-xs sm:max-w-sm break-words">
                                    <p class="text-white text-sm leading-relaxed" x-text="m.conteudo"></p>
                                </div>
                                <div class="flex items-center space-x-1 mt-1 text-xs text-gray-400">
                                    <span x-text="m.time"></span>
                                </div>
                            </div>
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mb-4">
                                <span class="text-white font-semibold text-xs" x-text="(m.author||'')[0]?.toUpperCase() || 'V'"></span>
                            </div>
                        </div>
                    </template>

                    <!-- De outros (esquerda) -->
                    <template x-if="!(m.is_own || m.user_id === currentUserId)">
                        <div class="flex items-end space-x-2 mb-2">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0 mb-4">
                                <span class="text-white font-semibold text-xs" x-text="(m.author||'')[0]?.toUpperCase() || '?' "></span>
                            </div>
                            <div class="flex-1 flex flex-col">
                                <div class="bg-white rounded-2xl rounded-tl-md shadow-sm p-3 max-w-xs sm:max-w-sm break-words">
                                    <p class="text-gray-900 text-sm leading-relaxed" x-text="m.conteudo"></p>
                                </div>
                                <div class="flex items-center space-x-1 mt-1 text-xs text-gray-400">
                                    <span class="font-medium text-gray-600" x-text="m.author"></span>
                                    <span>•</span>
                                    <span x-text="m.time"></span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </template>
        </div>

        <!-- Área de input -->
        <div class="bg-white border-t px-4 py-4">
            <form @submit.prevent="sendMessage" class="flex items-end space-x-3">
                <!-- Input de texto -->
                <div class="flex-1 relative">
                    <textarea 
                        x-model="newMessage"
                        @keydown.enter.prevent="handleEnter"
                        @input="handleInput"
                        placeholder="Digite sua mensagem..."
                        class="w-full resize-none border border-gray-200 rounded-2xl px-4 py-3 focus:outline-none focus:border-blue-primary focus:ring-2 focus:ring-blue-primary/20 transition-all min-h-[48px] max-h-32"
                        rows="1"
                        x-ref="messageInput"
                    ></textarea>
                </div>

                <!-- Botão enviar -->
                <button 
                    type="submit"
                    :disabled="!newMessage.trim()"
                    class="bg-blue-primary hover:bg-blue-hover disabled:bg-gray-300 disabled:cursor-not-allowed text-white rounded-full p-3 transition-colors flex-shrink-0"
                    title="Enviar mensagem"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
@endsection

@push('styles')
<style>
    /* Personalização da scrollbar */
    .overflow-y-auto::-webkit-scrollbar {
        width: 4px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-track {
        background: transparent;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 2px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
</style>
@endpush

@push('scripts')
<script>
    function chatPartida({ messagesIndexUrl, messagesStoreUrl, csrfToken, currentUserId }) {
        return {
            newMessage: '',
            messages: [],
            messagesIndexUrl,
            messagesStoreUrl,
            csrfToken,
            currentUserId,
            
            init() {
                this.fetchMessages();
                this.scrollToBottom();
                // Auto-resize do textarea
                this.$refs.messageInput.addEventListener('input', this.autoResize.bind(this));
                // Polling simples a cada 5s (pode ser substituído por Echo)
                this.poller = setInterval(() => this.fetchMessages(true), 5000);
            },
            
            async fetchMessages(keepScroll = false) {
                try {
                    const resp = await fetch(this.messagesIndexUrl, { headers: { 'Accept': 'application/json' }});
                    const data = await resp.json();
                    this.messages = data.data || [];
                    this.$nextTick(() => {
                        if (!keepScroll) this.scrollToBottom();
                    });
                } catch (e) {
                    console.error('Erro ao carregar mensagens', e);
                }
            },

            sendMessage() {
                if (!this.newMessage.trim()) return;
                this.postMessage(this.newMessage.trim());
            },

            async postMessage(text) {
                try {
                    const resp = await fetch(this.messagesStoreUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': this.csrfToken,
                        },
                        body: JSON.stringify({ conteudo: text }),
                    });
                    if (!resp.ok) throw new Error('Falha ao enviar mensagem');
                    const saved = await resp.json();
                    this.messages.push(saved);
                } catch (e) {
                    console.error(e);
                } finally {
                    this.newMessage = '';
                    this.autoResize();
                    this.$nextTick(() => this.scrollToBottom());
                }
            },
            
            handleEnter(event) {
                if (!event.shiftKey) {
                    this.sendMessage();
                }
            },
            
            handleInput() {
                this.autoResize();
            },
            
            autoResize() {
                const textarea = this.$refs.messageInput;
                textarea.style.height = 'auto';
                textarea.style.height = Math.min(textarea.scrollHeight, 128) + 'px';
            },
            
            scrollToBottom() {
                const container = this.$refs.messagesContainer;
                container.scrollTop = container.scrollHeight;
            }
        }
    }
</script>
@endpush