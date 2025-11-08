@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
    <x-header title="Editar Perfil" />

    <main class="px-4 py-6 flex justify-center">
        <div class="w-full max-w-lg bg-white rounded-2xl shadow-md p-6">
            <form method="POST" action="{{ route('perfil.update') }}" class="space-y-6">
                @csrf
                @method('PATCH')

                <!-- Informações pessoais -->
                <x-form.section title="Informações Pessoais">
                    <div class="space-y-4">
                        <x-form.input label="Nome completo" name="name" type="text" required
                            placeholder="Digite seu nome" value="{{ old('name', $user->name) }}" />

                        <x-form.input label="Email" name="email" type="email" required placeholder="Digite seu email"
                            value="{{ old('email', $user->email) }}" />

                        <x-form.input label="Telefone" name="telefone" type="tel" placeholder="(11) 99999-9999"
                            value="{{ old('telefone', $user->telefone) }}" />
                    </div>
                </x-form.section>

                <!-- Senha -->
                <x-form.section title="Alterar Senha (opcional)">
                    <div class="space-y-4">
                        <x-form.input label="Nova senha" name="password" type="password" placeholder="Digite sua senha" />

                        <x-form.input label="Confirmar senha" name="password_confirmation" type="password"
                            placeholder="Repita sua senha" />
                    </div>
                </x-form.section>

                <!-- Botão -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-blue-primary hover:bg-blue-hover text-white font-semibold py-4 px-6 rounded-2xl transition-all duration-200 shadow-md hover:shadow-lg">
                        Atualizar Perfil
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
