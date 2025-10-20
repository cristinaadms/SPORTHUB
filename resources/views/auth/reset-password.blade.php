@extends('layouts.auth') 

@section('title', 'Redefinir senha')
@section('titleHeader', 'SportHub')
@section('subtitle', 'Defina uma nova senha para sua conta')

@section('form')
<form method="POST" action="{{ route('password.update') }}" class="space-y-6">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">
    <x-form.input label="E-mail" name="email" type="email" value="{{ old('email', $email) }}" required />

    <x-form.input label="Nova senha" name="password" type="password" required placeholder="Digite sua nova senha" />
    <x-form.input label="Confirme a nova senha" name="password_confirmation" type="password" required placeholder="Confirme sua senha" />

    @if ($errors->any())
        <div class="text-red-600 text-sm space-y-1">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if (session('status'))
        <p class="text-green-600 text-sm">{{ session('status') }}</p> 
    @endif

    <button type="submit"
        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-blue-primary hover:bg-blue-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-primary transition-all duration-200 shadow-md hover:shadow-lg">
        Redefinir senha 
    </button>

    <div class="mt-6">
        <div class="relative flex justify-center text-sm">
            <span class="px-2 bg-white text-gray-500">Lembrou a senha?</span> 
        </div>

        <a href="{{ route('login') }}"
            class="mt-3 w-full flex justify-center py-3 px-4 border border-blue-primary text-sm font-semibold rounded-xl text-blue-primary bg-white hover:bg-blue-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-primary transition-all duration-200">
            Voltar para login 
        </a>
    </div>

    @if (session('status'))
        <script> 
            alert("{{ session('status') }}"):
        </script>
    @endif
</form>
@endsection