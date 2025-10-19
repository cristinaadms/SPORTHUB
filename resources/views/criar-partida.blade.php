@php
    $isEdit = isset($partida); // Verifica se é edição
    $formAction = $isEdit ? route('partidas.update', $partida->id) : route('partidas.store');
    $formMethod = $isEdit ? 'PUT' : 'POST';
    $pageTitle = $isEdit ? 'Editar Partida' : 'Criar Partida';
@endphp

@extends('layouts.app')

@section('title', 'SportHub - {{ $pageTitle }}')

@section('content')
    <x-header :title="$pageTitle" />

    <!-- Formulário -->
    <main class="px-4 py-6">
        <form id="criarPartidaForm" class="space-y-6" method="POST" action="{{ $formAction }}">
            @csrf
            @if ($isEdit)
                @method('PUT')
            @endif

            <x-form.section title="Informações da Partida">
                <div class="space-y-4">
                    <x-form.input label="Nome da partida" name="nome" :required="true" placeholder="Ex: Futebol Society"
                        :value="old('nome', $partida->nome ?? '')" />

                    <x-form.textarea label="Descrição (opcional)" name="descricao"
                        placeholder="Descreva detalhes sobre a partida..." :rows="3" :value="old('descricao', $partida->descricao ?? '')" />

                    <x-form.select-modalidade :required="true" :selected="old('modalidade', $partida->modalidade ?? '')" />
                </div>
            </x-form.section>


            <!-- Local -->
            <x-form.section title="Local">
                <x-form.select label="Selecione o local" name="local_id" :required="true" placeholder="Escolha um local"
                    :options="$locais->pluck('nome', 'id')" :selected="old('local_id', $partida->local_id ?? '')" />
            </x-form.section>

            <x-form.section title="Data e Horário">
                <div class="space-y-4">
                    <x-form.input type="datetime-local" label="Data e Horário" name="data" :required="true"
                        :value="old('data')" :value="old('data', $partida ? $partida->data->format('Y-m-d\TH:i') : '')" />
                </div>
            </x-form.section>

            <x-form.section title="Configurações">
                <div class="space-y-4">
                    <!-- Número máximo de participantes -->
                    <x-form.input type="number" label="Número máximo de participantes" name="quantPessoas"
                        :required="true" min="2" max="50" :value="old('quantPessoas', $partida->quantPessoas ?? '10')" />

                    <x-form.input type="number" label="Valor da partida" name="valor" :required="true" min="0"
                        step="0.01" :value="old('valor', $partida->valor ?? '0')" />

                    <!-- Toggle Pública/Privada -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Tipo de partida
                        </label>

                        <div class="flex items-center space-x-3">
                            <span class="text-gray-700 text-sm">Privada</span>

                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="tipo-toggle" name="tipo" value="publica" class="sr-only peer"
                                    {{ old('tipo', $partida->tipo ?? 'publica') === 'publica' ? 'checked' : '' }}>
                                <div
                                    class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-primary relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full">
                                </div>
                            </label>

                            <span class="text-gray-700 text-sm">Pública</span>
                        </div>

                        <div class="mt-2 text-sm text-gray-secondary">
                            <span id="tipo-descricao"></span>
                        </div>
                    </div>

                </div>
            </x-form.section>

            <!-- Botão Criar Partida -->
            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-blue-primary hover:bg-blue-hover text-white font-semibold py-4 px-6 rounded-2xl transition-all duration-200 shadow-md hover:shadow-lg">
                    {{ $isEdit ? 'Atualizar Partida' : 'Criar Partida' }}
                </button>
            </div>
        </form>
    </main>
@endsection

@push('scripts')
    <script>
        // Toggle Pública/Privada
        const toggle = document.getElementById('tipo-toggle');
        const descricao = document.getElementById('tipo-descricao');

        function atualizarDescricao() {
            descricao.textContent = toggle.checked ?
                'Qualquer pessoa pode se inscrever na partida' :
                'Apenas pessoas convidadas podem participar';
        }

        atualizarDescricao();

        toggle.addEventListener('change', atualizarDescricao);


        // Validação de data e hora apenas à partir da atual
        const dataInput = document.getElementById('data');
        if (dataInput) {
            // Data e hora atual em formato YYYY-MM-DDTHH:MM
            const agora = new Date();
            const pad = num => String(num).padStart(2, '0');
            const dataMin = agora.getFullYear() + '-' +
                pad(agora.getMonth() + 1) + '-' +
                pad(agora.getDate()) + 'T' +
                pad(agora.getHours()) + ':' +
                pad(agora.getMinutes());

            dataInput.min = dataMin;

            // Se não tiver valor (nova partida), coloca o valor atual
            if (!dataInput.value) {
                dataInput.value = dataMin;
            }
        }
    </script>
@endpush
