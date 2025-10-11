@extends('layouts.auth')

@section('title', 'SportHub - Cadastro')
@section('titleHeader', 'SportHub')
@section('subtitle', 'Crie sua conta')

@section('form')
    <form class="space-y-6" method="POST" action="{{ route('register') }}">
        @csrf
        <x-form.input label="Nome completo" name="name" type="text" required placeholder="Digite seu nome" />
        <x-form.input label="Email" name="email" type="email" required placeholder="Digite seu email" />
        <x-form.input label="Telefone" name="telefone" type="tel" required placeholder="(11) 99999-9999" />
        <x-form.input label="Senha" name="password" type="password" required placeholder="Digite sua senha" />
        <x-form.input label="Confirmar senha" name="password_confirmation" type="password" required
            placeholder="Repita sua senha" />

        <div class="flex items-center">
            <input id="terms" name="terms" type="checkbox" required
                class="h-4 w-4 text-blue-primary focus:ring-blue-primary border-gray-300 rounded">
            <label for="terms" class="ml-2 block text-sm text-gray-900">
                Aceito os <a href="#" class="text-blue-primary hover:text-blue-hover">termos de uso</a> e <a
                    href="#" class="text-blue-primary hover:text-blue-hover">política de privacidade</a>
            </label>
        </div>

        <button type="submit"
            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-blue-primary hover:bg-blue-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-primary transition-all duration-200 shadow-md hover:shadow-lg">
            Criar conta
        </button>

        <div class="mt-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Já tem uma conta?</span>
                </div>
            </div>

            <a href="{{ route('login') }}"
                class="mt-6 w-full flex justify-center py-3 px-4 border border-blue-primary text-sm font-semibold rounded-xl text-blue-primary bg-white hover:bg-blue-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-primary transition-all duration-200">
                Fazer login
            </a>
        </div>
    </form>
@endsection
