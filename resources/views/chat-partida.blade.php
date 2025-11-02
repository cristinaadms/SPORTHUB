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
    <div class="flex flex-col h-[calc(100vh-140px)]" x-data="chatPartida()">
        
        <!-- Área de mensagens -->
        <div class="flex-1 overflow-y-auto px-4 py-4 space-y-4 bg-gray-50" x-ref="messagesContainer">
            <!-- Mensagem de sistema -->
            <x-system-message message="Chat da partida iniciado" />

            <!-- Mensagens exemplo -->
            <x-chat-message 
                author="João Silva" 
                message="Pessoal, vamos nos encontrar 15 minutos antes na entrada principal!" 
                time="14:30"
                color="blue"
            />

            <x-chat-message 
                author="Você" 
                message="Perfeito! Estarei lá." 
                time="14:32"
                color="green"
                :isOwn="true"
            />

            <x-chat-message 
                author="Maria Santos" 
                message="Alguém tem uma bola extra? A minha furou 😅" 
                time="14:35"
                color="purple"
            />

            <x-chat-message 
                author="Carlos Lima" 
                message="Tenho sim! Levo duas bolas." 
                time="14:36"
                color="orange"
            />

            <x-chat-message 
                author="Você" 
                message="Ótimo! Vou levar água para o pessoal também." 
                time="14:38"
                color="green"
                :isOwn="true"
            />
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
    function chatPartida() {
        return {
            newMessage: '',
            
            init() {
                this.scrollToBottom();
                // Auto-resize do textarea
                this.$refs.messageInput.addEventListener('input', this.autoResize.bind(this));
            },
            
            sendMessage() {
                if (!this.newMessage.trim()) return;
                
                // Simular envio de mensagem
                console.log('Enviando mensagem:', this.newMessage);
                
                // Limpar input
                this.newMessage = '';
                this.autoResize();
                
                // Scroll para o final
                this.$nextTick(() => {
                    this.scrollToBottom();
                });
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