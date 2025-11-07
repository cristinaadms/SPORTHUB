<div x-data="{ open: false }">
    <!-- Botão que abre o modal -->
    <button 
        @click="open = true"
        class="w-full py-3 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white font-semibold rounded-xl hover:from-yellow-500 hover:to-yellow-600 transition-all duration-300 shadow-md hover:shadow-lg col-span-2 text-center transform hover:scale-[1.02]">
        ⭐ Avaliar Partida
    </button>

    <!-- Modal -->
    <div 
        x-show="open" 
        x-cloak 
        class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 animate-in fade-in duration-200"
        @click.self="open = false">
        
        <div class="bg-white w-11/12 max-w-md rounded-2xl shadow-2xl p-8 space-y-6 animate-in slide-in-from-bottom-4 duration-300">
            <!-- Cabeçalho -->
            <div class="text-center space-y-2">
                <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center mx-auto shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.803 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118L10 13.347l-2.884 2.034c-.785.57-1.84-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L3.48 8.72c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Avaliar Partida</h2>
                <p class="text-sm text-gray-500">Compartilhe sua experiência</p>
            </div>

            <form action="{{ route('avaliacoes.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="partida_id" value="{{ $partida->id }}">

                <!-- Estrelas -->
                <div x-data="{ rating: 0 }" class="space-y-3">
                    <label class="block text-sm font-medium text-gray-700 text-center">
                        Sua avaliação
                    </label>
                    <div class="flex justify-center space-x-2">
                        <template x-for="i in 5">
                            <svg 
                                @click="rating = i; $refs.input.value = i"
                                @mouseenter="$el.style.transform = 'scale(1.15)'"
                                @mouseleave="$el.style.transform = 'scale(1)'"
                                :class="rating >= i ? 'text-yellow-400 drop-shadow-md' : 'text-gray-300'"
                                class="w-10 h-10 cursor-pointer transition-all duration-200 hover:drop-shadow-lg" 
                                fill="currentColor" 
                                viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.803 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118L10 13.347l-2.884 2.034c-.785.57-1.84-.197-1.54-1.118l1.07-3.292a1 1 0 00-.364-1.118L3.48 8.72c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z" />
                            </svg>
                        </template>
                    </div>
                    <input x-ref="input" type="hidden" name="estrelas" required>
                    <p x-show="rating > 0" class="text-center text-sm text-gray-600 font-medium" x-text="`${rating} ${rating === 1 ? 'estrela' : 'estrelas'}`"></p>
                </div>

                <!-- Feedback -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Comentário <span class="text-gray-400 font-normal">(opcional)</span>
                    </label>
                    <textarea 
                        name="feedback" 
                        rows="4" 
                        maxlength="500"
                        class="w-full border-2 border-gray-200 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-200 rounded-xl px-4 py-3 text-sm transition-all duration-200 resize-none"
                        placeholder="Conte-nos sobre sua experiência na partida..."></textarea>
                    <p class="text-xs text-gray-400 text-right">Máximo 500 caracteres</p>
                </div>

                <!-- Botões -->
                <div class="flex gap-3 pt-2">
                    <button 
                        type="button" 
                        @click="open = false"
                        class="w-1/2 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors duration-200">
                        Cancelar
                    </button>
                    <button 
                        type="submit"
                        class="w-1/2 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-[1.02]">
                        Enviar Avaliação
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>