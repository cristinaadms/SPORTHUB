@extends('layouts.app')

@section('title', 'SportHub - Detalhes da Partida')

@section('content')
    <x-header title="Detalhes da Partida" :backButton="true" />

    <!-- Conteúdo principal -->
    <main class="px-4 py-6 space-y-6">
        <!-- Card principal da partida -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <x-partida-header tipo="publica" status="confirmado" titulo="Futebol Society"
                descricao="Partida amistosa entre amigos" />


            <!-- Informações da partida -->
            <div class="p-6 space-y-4">
                <x-partida-info-grid local="Arena Sports Center" horario="19:00 - 21:00" data="Hoje"
                    participantes="8/10" />

                <x-descricao-card
                    descricao="Partida amistosa de futebol society. Venha se divertir e fazer novos amigos! Nível iniciante a intermediário. Chuteiras recomendadas." />
            </div>
        </div>

        <x-participantes-list :participantes="[
            ['nome' => 'Marcos Silva', 'organizador' => true, 'cor' => 'blue'],
            ['nome' => 'João Santos', 'cargo' => 'Você', 'cor' => 'green', 'status' => 'Confirmado'],
            ['nome' => 'Ana Costa', 'cargo' => 'Meia', 'cor' => 'purple', 'status' => 'Confirmado'],
            ['nome' => 'Pedro Lima', 'cargo' => 'Atacante', 'cor' => 'red', 'status' => 'Confirmado'],
            ['nome' => 'Carlos Mendes', 'cargo' => 'Zagueiro', 'cor' => 'indigo', 'status' => 'Confirmado'],
            ['nome' => 'Lucas Oliveira', 'cargo' => 'Goleiro', 'cor' => 'yellow', 'status' => 'Confirmado'],
            ['nome' => 'Fernanda Rocha', 'cargo' => 'Lateral', 'cor' => 'pink', 'status' => 'Confirmado'],
            ['nome' => 'Rafael Souza', 'cargo' => 'Volante', 'cor' => 'teal', 'status' => 'Confirmado'],
        ]" />

        <x-partida-actions />
    </main>
@endsection