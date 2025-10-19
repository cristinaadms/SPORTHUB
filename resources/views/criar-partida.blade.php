@extends('layouts.app')

@section('title', 'SportHub - Criar Partida')

@section('content')
    <x-header title="Criar Partida" />

    <!-- Formulário -->
    <main class="px-4 py-6">
        <form id="criarPartidaForm" class="space-y-6" method="POST" action="{{ route('partidas.store') }}">
            @csrf

            <x-form.section title="Informações da Partida">
                <div class="space-y-4">
                    <x-form.input label="Nome da partida" name="nome" :required="true" placeholder="Ex: Futebol Society"
                        :value="old('nome')" />

                    <x-form.textarea label="Descrição (opcional)" name="descricao"
                        placeholder="Descreva detalhes sobre a partida..." :rows="3" />

                    <x-form.select-modalidade :required="true" :value="old('modalidade')" />
                </div>
            </x-form.section>


            <!-- Local -->
            <x-form.section title="Local">
                <x-form.select label="Selecione o local" name="local_id" :required="true" placeholder="Escolha um local"
                    :options="$locais->pluck('nome', 'id')" />
            </x-form.section>

            <x-form.section title="Data e Horário">
                <div class="space-y-4">
                    <x-form.input type="datetime-local" label="Data e Horário" name="data" :required="true"
                        :value="old('data')" />
                </div>
            </x-form.section>

            <x-form.section title="Configurações">
                <div class="space-y-4">
                    <!-- Número máximo de participantes -->
                    <x-form.input type="number" label="Número máximo de participantes" name="quantPessoas"
                        :required="true" value="10" min="2" max="50" />

                    <x-form.input type="number" label="Valor da partida" name="valor" :required="true" value="0"
                        min="0" step="0.01" />

                    <!-- Toggle Pública/Privada -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Tipo de partida
                        </label>

                        <div class="flex items-center space-x-3">
                            <span class="text-gray-700 text-sm">Privada</span>

                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="tipo-toggle" name="tipo" value="publica" class="sr-only peer"
                                    checked>
                                <div
                                    class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-primary relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full">
                                </div>
                            </label>

                            <span class="text-gray-700 text-sm">Pública</span>
                        </div>

                        <div class="mt-2 text-sm text-gray-secondary">
                            <span id="tipo-descricao">Qualquer pessoa pode se inscrever na partida</span>
                        </div>
                    </div>

                </div>
            </x-form.section>

            <!-- Botão Criar Partida -->
            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-blue-primary hover:bg-blue-hover text-white font-semibold py-4 px-6 rounded-2xl transition-all duration-200 shadow-md hover:shadow-lg">
                    Criar Partida
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

        toggle.addEventListener('change', () => {
            // Atualiza o valor do campo "tipo" dinamicamente
            toggle.value = toggle.checked ? 'publica' : 'privada';
            descricao.textContent = toggle.checked ?
                'Qualquer pessoa pode se inscrever na partida' :
                'Apenas pessoas convidadas podem participar';
        });

        // Definir data mínima como hoje
        const hoje = new Date().toISOString().split('T')[0];
        const dataInput = document.getElementById('data');
        if (dataInput) {
            dataInput.min = hoje;
            dataInput.value = hoje;
        }

        // Validação do formulário
        const form = document.getElementById('criarPartidaForm');
        form.addEventListener('submit', function(e) {
            const horarioInicio = document.getElementById('horario-inicio').value;
            const horarioFim = document.getElementById('horario-fim').value;

            if (horarioInicio >= horarioFim) {
                e.preventDefault();
                alert('O horário de fim deve ser posterior ao horário de início!');
                return;
            }
        });
    </script>
@endpush
