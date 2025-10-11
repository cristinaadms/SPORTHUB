@props(['text', 'color' => 'blue'])

@php
$colors = [
    'blue' => 'bg-blue-light text-blue-text',
    'green' => 'bg-green-100 text-green-800',
    'yellow' => 'bg-yellow-100 text-yellow-800',
    'red' => 'bg-red-100 text-red-800',
    'gray' => 'bg-gray-100 text-gray-600',
];
@endphp

<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $colors[$color] ?? $colors['blue'] }}">
    {{ $text }}
</span>
