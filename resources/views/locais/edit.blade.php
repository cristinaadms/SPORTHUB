@extends('layouts.app')

@section('title', 'SportHub - Editar Local')

@section('content')
    <x-header title="Editar Local" />

    <!-- Conteúdo principal -->
    <main class="px-4 py-6">
        <div class="bg-white rounded-2xl shadow-md">
            <form action="{{ route('local.update', $local->id) }}" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Informações Básicas -->
                <x-form.section title="Informações Básicas">
                    <x-form.input label="Nome do Local" name="nome" placeholder="Ex: Arena Sports Center"
                        value="{{ $local->nome }}" required help="Digite um nome descritivo para o local" />
                </x-form.section>

                <!-- Localização -->
                <x-form.section title="Localização">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-form.input label="Latitude" name="latitude" placeholder="-23.550520"
                            value="{{ $local->latitude }}" required help="Coordenada de latitude" />

                        <x-form.input label="Longitude" name="longitude" placeholder="-46.633308"
                            value="{{ $local->longitude }}" required help="Coordenada de longitude" />
                    </div>

                    {{-- Dica --}}
                    <div class="mt-4 p-4 bg-blue-light rounded-xl">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-blue-primary mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-blue-text">Dica para obter coordenadas:</p>
                                <p class="text-xs text-blue-text mt-1">
                                    Acesse o Google Maps, clique com o botão direito no local desejado e copie as
                                    coordenadas que aparecem no menu.
                                </p>
                            </div>
                        </div>
                    </div>
                </x-form.section>

                {{-- Imagem --}}
                <x-form.section title="Imagem do Local">
                    <x-form.input label="Foto do Local" name="imagem" type="file"
                        help="Máximo 2MB. Formatos aceitos: JPG, PNG, GIF" onchange="previewImage(event)" />

                    {{-- Preview --}}
                    <div id="imagePreview" class="hidden">
                        <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                        <div class="relative w-full h-48 bg-gray-100 rounded-xl overflow-hidden">
                            <img id="previewImg" src="" alt="Preview" class="w-full h-full object-cover">
                            <button type="button" onclick="removePreview()"
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </x-form.section>


                <x-form.section title="Imagem do Local">
                    <x-form.input label="{{ $local->imagem ? 'Nova Foto do Local' : 'Foto do Local' }}" name="imagem"
                        type="file" :current="$local->imagem ? 'data:image/jpeg;base64,' . base64_encode($local->imagem) : null"
                        help="{{ $local->imagem ? 'Deixe em branco para manter a imagem atual. ' : '' }}Máximo 2MB. Formatos aceitos: JPG, PNG, GIF" />

                    {{-- Preview da nova imagem --}}
                    <div id="imagePreview" class="hidden">
                        <p class="text-sm font-medium text-gray-700 mb-2">Nova imagem (preview):</p>
                        <div class="relative w-full h-48 bg-gray-100 rounded-xl overflow-hidden">
                            <img id="previewImg" src="" alt="Preview" class="w-full h-full object-cover">
                            <button type="button" onclick="removePreview()"
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </x-form.section>

                <!-- Informações Adicionais -->
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Informações do Sistema</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-xl">
                            <p class="text-sm font-medium text-gray-700">Criado em:</p>
                            <p class="text-sm text-gray-600">{{ $local->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-xl">
                            <p class="text-sm font-medium text-gray-700">Última atualização:</p>
                            <p class="text-sm text-gray-600">{{ $local->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Botões de Ação -->
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 pt-6">
                    <button type="button" onclick="history.back()"
                        class="flex-1 px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancelar
                    </button>
                    <button type="submit"
                        class="flex-1 px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-xl transition-colors">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>

        <!-- Área de Perigo -->
        <div class="bg-white rounded-2xl shadow-md mt-6">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-red-600 mb-4">Área de Perigo</h2>
                <p class="text-sm text-gray-600 mb-4">
                    Ao excluir este local, todas as partidas associadas podem ser afetadas. Esta ação não pode ser
                    desfeita.
                </p>
                <button type="button" onclick="confirmarExclusao()"
                    class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-xl transition-colors">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Excluir Local
                </button>
            </div>
        </div>
    </main>

    <!-- Modal Confirmação Exclusão -->
    <div id="modalExcluir" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center justify-center mb-4">
                    <div class="bg-red-100 rounded-full p-3">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-xl font-bold text-gray-900 text-center mb-2">Confirmar Exclusão</h2>
                <p class="text-gray-600 text-center mb-6">
                    Tem certeza que deseja excluir o local <strong>"{{ $local->nome }}"</strong>? Esta ação não pode
                    ser desfeita.
                </p>

                <div class="flex space-x-3">
                    <button type="button" onclick="toggleModal('modalExcluir')"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Cancelar
                    </button>
                    <form action="{{ route('local.destroy', $local->id) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                            Excluir
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        // Preview da imagem
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        // Remover preview
        function removePreview() {
            document.getElementById('imagem').value = '';
            document.getElementById('imagePreview').classList.add('hidden');
        }

        // Modal de exclusão
        function confirmarExclusao() {
            document.getElementById('modalExcluir').classList.remove('hidden');
        }

        function toggleModal(modalId) {
            document.getElementById(modalId).classList.toggle('hidden');
        }

        // Fechar modal clicando fora
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('fixed') && e.target.classList.contains('inset-0')) {
                e.target.classList.add('hidden');
            }
        });

        // Auto-fechar mensagens de erro após 10 segundos
        setTimeout(function() {
            const errorAlert = document.querySelector('.bg-red-100');
            if (errorAlert) {
                errorAlert.style.transition = 'opacity 0.5s';
                errorAlert.style.opacity = '0';
                setTimeout(() => errorAlert.remove(), 500);
            }
        }, 10000);

        // Validação básica do formulário
        document.querySelector('form').addEventListener('submit', function(e) {
            const nome = document.getElementById('nome').value.trim();
            const latitude = document.getElementById('latitude').value.trim();
            const longitude = document.getElementById('longitude').value.trim();

            if (!nome || !latitude || !longitude) {
                e.preventDefault();
                alert('Por favor, preencha todos os campos obrigatórios.');
                return false;
            }

            // Validar formato básico das coordenadas
            const latRegex = /^-?([0-8]?[0-9]|90)\.?[0-9]*$/;
            const lonRegex = /^-?((1[0-7][0-9]|[0-9]{1,2})\.?[0-9]*|180\.?0*)$/;

            if (!latRegex.test(latitude)) {
                e.preventDefault();
                alert('Por favor, insira uma latitude válida (ex: -23.550520).');
                return false;
            }

            if (!lonRegex.test(longitude)) {
                e.preventDefault();
                alert('Por favor, insira uma longitude válida (ex: -46.633308).');
                return false;
            }
        });
    </script>
@endpush
