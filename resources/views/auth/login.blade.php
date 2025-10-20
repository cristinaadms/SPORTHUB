@extends('layouts.auth')

@section('title', 'SportHub - Login')
@section('titleHeader', 'SportHub')
@section('subtitle', 'Entre na sua conta')

@section('form')
    <form class="space-y-6" id="loginForm" action="{{ route('login') }}" method="POST">
        @csrf

        <x-form.input label="Email" name="email" type="email" required placeholder="Digite seu email" />
        <x-form.input label="Senha" name="password" type="password" required placeholder="Digite sua senha" />

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember" name="remember" type="checkbox"
                    class="h-4 w-4 text-blue-primary focus:ring-blue-primary border-gray-300 rounded">
                <label for="remember" class="ml-2 block text-sm text-gray-900">
                    Lembrar de mim
                </label>
            </div>

            <div class="text-sm">
                <a href="{{ route('password.request') }}" class="font-medium text-blue-primary hover:text-blue-hover transition-colors">
                    Esqueceu a senha?
                </a>
            </div>
        </div>

        <button type="submit"
            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-blue-primary hover:bg-blue-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-primary transition-all duration-200 shadow-md hover:shadow-lg">
            Entrar
        </button>

        <div class="mt-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Não tem uma conta?</span>
                </div>
            </div>

            <a href="{{ route('register') }}"
                class="mt-6 w-full flex justify-center py-3 px-4 border border-blue-primary text-sm font-semibold rounded-xl text-blue-primary bg-white hover:bg-blue-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-primary transition-all duration-200">
                Criar conta
            </a>
        </div>
    </form>
@endsection
