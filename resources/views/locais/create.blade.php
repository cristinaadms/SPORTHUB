<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportHub - Criar Local</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'blue-primary': '#2563EB',
                        'blue-hover': '#1D4ED8',
                        'blue-light': '#EFF6FF',
                        'blue-text': '#1E40AF',
                        'gray-secondary': '#6B7280',
                        'gray-light': '#E5E7EB'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 pb-20">
    <!-- Header -->
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
                        <h1 class="text-xl font-bold text-gray-900">Criar Local</h1>
                        <p class="text-sm text-gray-secondary">Adicionar novo local esportivo</p>
                    </div>
                </div>
                <div class="bg-blue-primary rounded-xl p-2">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </header>

    <!-- Conteúdo principal -->
    <main class="px-4 py-6">
        <!-- Mensagens de erro -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6" role="alert">
                <div class="flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <p class="font-semibold mb-1">Por favor, corrija os seguintes erros:</p>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Formulário de Criação -->
        <div class="bg-white rounded-2xl shadow-md">
            <form action="{{ route('locais.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                
                <!-- Informações Básicas -->
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Informações Básicas</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">
                                Nome do Local <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-colors"
                                placeholder="Ex: Arena Sports Center">
                            <p class="text-xs text-gray-500 mt-1">Digite um nome descritivo para o local</p>
                        </div>
                    </div>
                </div>

                <!-- Localização -->
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Localização</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">
                                Latitude <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-colors"
                                placeholder="-23.550520">
                            <p class="text-xs text-gray-500 mt-1">Coordenada de latitude</p>
                        </div>
                        <div>
                            <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">
                                Longitude <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-colors"
                                placeholder="-46.633308">
                            <p class="text-xs text-gray-500 mt-1">Coordenada de longitude</p>
                        </div>
                    </div>

                    <div class="mt-4 p-4 bg-blue-light rounded-xl">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-blue-primary mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-blue-text">Dica para obter coordenadas:</p>
                                <p class="text-xs text-blue-text mt-1">
                                    Acesse o Google Maps, clique com o botão direito no local desejado e copie as coordenadas que aparecem no menu.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Imagem -->
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Imagem do Local</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="imagem" class="block text-sm font-medium text-gray-700 mb-2">
                                Foto do Local
                            </label>
                            <div class="relative">
                                <input type="file" id="imagem" name="imagem" accept="image/*"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-colors"
                                    onchange="previewImage(event)">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Máximo 2MB. Formatos aceitos: JPG, PNG, GIF</p>
                        </div>

                        <!-- Preview da imagem -->
                        <div id="imagePreview" class="hidden">
                            <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                            <div class="relative w-full h-48 bg-gray-100 rounded-xl overflow-hidden">
                                <img id="previewImg" src="" alt="Preview" class="w-full h-full object-cover">
                                <button type="button" onclick="removePreview()" 
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botões de Ação -->
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 pt-6">
                    <button type="button" onclick="history.back()"
                        class="flex-1 px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancelar
                    </button>
                    <button type="submit"
                        class="flex-1 px-6 py-3 bg-blue-primary hover:bg-blue-hover text-white font-semibold rounded-xl transition-colors">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Criar Local
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Menu inferior fixo -->
    <x-menu-inferior />

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
</body>

</html>