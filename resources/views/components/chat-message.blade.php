@props([
    'author',
    'message', 
    'time',
    'isOwn' => false,
    'color' => 'blue'
])

@php
$avatarColors = [
    'blue' => 'bg-blue-500',
    'green' => 'bg-green-500',
    'purple' => 'bg-purple-500',
    'orange' => 'bg-orange-500',
    'red' => 'bg-red-500',
    'yellow' => 'bg-yellow-500',
    'pink' => 'bg-pink-500',
    'indigo' => 'bg-indigo-500',
];

$avatarClass = $avatarColors[$color] ?? 'bg-blue-500';
$authorInitial = strtoupper(substr($author, 0, 1));
@endphp

@if($isOwn)
    <!-- Mensagem própria (à direita) -->
    <div class="flex items-end space-x-2 justify-end mb-2">
        <div class="flex-1 flex flex-col items-end">
            <div class="bg-blue-primary rounded-2xl rounded-tr-md shadow-sm p-3 max-w-xs sm:max-w-sm break-words">
                <p class="text-white text-sm leading-relaxed">{{ $message }}</p>
            </div>
            <div class="flex items-center space-x-1 mt-1 text-xs text-gray-400">
                <span>{{ $time }}</span>
            </div>
        </div>
        <div class="w-8 h-8 {{ $avatarClass }} rounded-full flex items-center justify-center flex-shrink-0 mb-4">
            <span class="text-white font-semibold text-xs">{{ $authorInitial }}</span>
        </div>
    </div>
@else
    <!-- Mensagem de outro usuário (à esquerda) -->
    <div class="flex items-end space-x-2 mb-2">
        <div class="w-8 h-8 {{ $avatarClass }} rounded-full flex items-center justify-center flex-shrink-0 mb-4">
            <span class="text-white font-semibold text-xs">{{ $authorInitial }}</span>
        </div>
        <div class="flex-1 flex flex-col">
            <div class="bg-white rounded-2xl rounded-tl-md shadow-sm p-3 max-w-xs sm:max-w-sm break-words">
                <p class="text-gray-900 text-sm leading-relaxed">{{ $message }}</p>
            </div>
            <div class="flex items-center space-x-1 mt-1 text-xs text-gray-400">
                <span class="font-medium text-gray-600">{{ $author }}</span>
                <span>•</span>
                <span>{{ $time }}</span>
            </div>
        </div>
    </div>
@endif