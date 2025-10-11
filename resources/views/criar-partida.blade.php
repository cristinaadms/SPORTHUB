@extends('layouts.app')

@section('title', 'SportHub - Criar Partida')

@section('content')
    <x-header title="Criar Partida" />

    <!-- Formulário -->
    <main class="px-4 py-6">
        <form id="criarPartidaForm" class="space-y-6">
            @csrf

            <x-form.section title="Informações da Partida">
                <div class="space-y-4">
                    <x-form.input label="Nome da partida" name="nome" :required="true" placeholder="Ex: Futebol Society" />

                    <x-form.textarea label="Descrição (opcional)" name="descricao"
                        placeholder="Descreva detalhes sobre a partida..." :rows="3" />
                </div>
            </x-form.section>


            <!-- Local -->
            <x-form.section title="Local">
                <x-form.select label="Selecione o local" name="local" :required="true" placeholder="Escolha um local"
                    :options="[
                        'arena-sports' => 'Arena Sports Center',
                        'quadra-parque' => 'Quadra do Parque',
                        'praia-copacabana' => 'Praia de Copacabana',
                        'clube-tenis' => 'Clube de Tênis',
                        'ginasio-municipal' => 'Ginásio Municipal',
                        'campo-universitario' => 'Campo Universitário',
                    ]" />
            </x-form.section>

            <x-form.section title="Data e Horário">
                <div class="space-y-4">
                    <x-form.input type="date" label="Data" name="data" :required="true" />

                    <div class="grid grid-cols-2 gap-4">
                        <x-form.input type="time" label="Horário de início" name="horario-inicio" :required="true" />

                        <x-form.input type="time" label="Horário de fim" name="horario-fim" :required="true" />
                    </div>
                </div>
            </x-form.section>

            <x-form.section title="Configurações">
                <div class="space-y-4">
                    <!-- Número máximo de participantes -->
                    <x-form.input type="number" label="Número máximo de participantes" name="max-participantes"
                        :required="true" value="10" min="2" max="50" />

                    <!-- Toggle Pública/Privada -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Tipo de partida
                        </label>
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="tipo" value="publica" checked class="sr-only peer">
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-primary">
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-700">Pública</span>
                            </label>
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
        // Toggle entre Pública e Privada
        const radioButtons = document.querySelectorAll('input[name="tipo"]');
        const tipoDescricao = document.getElementById('tipo-descricao');

        // Criar radio button para Privada
        const publicaLabel = document.querySelector('label:has(input[value="publica"])');
        const privadaLabel = document.createElement('label');
        privadaLabel.className = 'flex items-center cursor-pointer';
        privadaLabel.innerHTML = `
            <input type="radio" name="tipo" value="privada" class="sr-only peer">
            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-400"></div>
            <span class="ml-3 text-sm font-medium text-gray-700">Privada</span>
        `;

        publicaLabel.parentNode.appendChild(privadaLabel);

        // Atualizar descrição baseada na seleção
        document.addEventListener('change', function(e) {
            if (e.target.name === 'tipo') {
                if (e.target.value === 'publica') {
                    tipoDescricao.textContent = 'Qualquer pessoa pode se inscrever na partida';
                } else {
                    tipoDescricao.textContent = 'Apenas pessoas convidadas podem participar';
                }
            }
        });

        // Definir data mínima como hoje
        const hoje = new Date().toISOString().split('T')[0];
        document.getElementById('data').min = hoje;
        document.getElementById('data').value = hoje;

        // Validação do formulário
        document.getElementById('criarPartidaForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const horarioInicio = document.getElementById('horario-inicio').value;
            const horarioFim = document.getElementById('horario-fim').value;

            if (horarioInicio >= horarioFim) {
                alert('O horário de fim deve ser posterior ao horário de início!');
                return;
            }

            // Simular criação da partida
            alert('Partida criada com sucesso!');
            window.location.href = "{{ route('index') }}";
        });
    </script>
@endpush
