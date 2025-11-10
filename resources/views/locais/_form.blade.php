<form action="{{ isset($local) ? route('local.update', $local->id) : route('local.store') }}" method="POST"
    enctype="multipart/form-data" class="p-6 space-y-6">

    @csrf
    @if (isset($local))
        @method('PUT')
    @endif

    <!-- Informações Básicas -->
    <x-form.section title="Informações Básicas">
        <x-form.input label="Nome do Local" name="nome" placeholder="Ex: Arena Sports Center" :value="$local->nome ?? ''" required
            help="Digite um nome descritivo para o local" />
    </x-form.section>

    <!-- Localização -->
    <x-form.section title="Localização">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form.input label="Latitude" name="latitude" placeholder="-23.550520" :value="$local->latitude ?? ''" required
                help="Coordenada de latitude" />

            <x-form.input label="Longitude" name="longitude" placeholder="-46.633308" :value="$local->longitude ?? ''" required
                help="Coordenada de longitude" />
        </div>

        {{-- Botão para abrir o mapa --}}
        <div class="mt-3">
            <button type="button" onclick="abrirMapa()"
                class="px-4 py-2 bg-blue-primary text-white rounded-lg hover:bg-blue-hover transition">
                Escolher no mapa
            </button>
        </div>
    </x-form.section>

    {{-- Imagem --}}
    <x-form.section title="Imagem do Local">
        <x-form.input label="{{ isset($local) && $local->imagem ? 'Nova Foto do Local' : 'Foto do Local' }}"
            name="imagem" type="file" help="Máximo 2MB. Formatos aceitos: JPG, PNG, GIF"
            onchange="previewImage(event)" />

        @if (isset($local) && $local->imagem)
            <div class="mt-3">
                <p class="text-sm font-medium text-gray-700 mb-2">Imagem atual:</p>
                <img src="{{ $local->imagem }}" alt="Imagem do local"
                    class="w-full h-48 object-cover rounded-xl rounded-lg shadow-md">

            </div>
        @endif

        {{-- Preview --}}
        <div id="imagePreview" class="hidden mt-3">
            <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
            <div class="relative w-full h-48 bg-gray-100 rounded-xl overflow-hidden">
                <img id="previewImg" src="" alt="Preview" class="w-full h-full object-cover">
                <button type="button" onclick="removePreview()"
                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors">
                    ✕
                </button>
            </div>
        </div>
    </x-form.section>

    {{-- Botões de Ação --}}
    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 pt-6">
        <button type="button" onclick="history.back()"
            class="flex-1 px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition-colors">
            Cancelar
        </button>
        <button type="submit"
            class="flex-1 px-6 py-3 bg-blue-primary hover:bg-blue-hover text-white font-semibold rounded-xl transition-colors">
            {{ isset($local) ? 'Salvar Alterações' : 'Criar Local' }}
        </button>
    </div>
</form>

{{-- Modal do mapa --}}
@include('locais.partials.modal-mapa')