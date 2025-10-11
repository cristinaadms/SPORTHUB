@props(['tipo' => 'publica', 'status' => 'confirmado', 'titulo', 'descricao'])

<div class="h-48 bg-gradient-to-br from-blue-primary to-blue-hover relative">
    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
    <div class="absolute bottom-4 left-4 right-4">
        <div class="flex items-center space-x-2 mb-2">
            <x-badge :text="ucfirst($tipo)" color="blue" />
            <x-badge :text="ucfirst($status)" color="green" />
        </div>
        <h1 class="text-2xl font-bold text-white mb-1">{{ $titulo }}</h1>
        <p class="text-blue-100 text-sm">{{ $descricao }}</p>
    </div>
</div>
