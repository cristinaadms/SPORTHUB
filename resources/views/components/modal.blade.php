@props([
    'id' => 'modal',
    'title' => '',
    'type' => 'info' // info, warning, danger
])

@php
    $iconColors = [
        'info' => 'bg-blue-100 text-blue-600',
        'warning' => 'bg-yellow-100 text-yellow-600',
        'danger' => 'bg-red-100 text-red-600',
    ];
@endphp

<div id="{{ $id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full">
        <div class="p-6">
            <div class="flex items-center justify-center mb-4">
                <div class="{{ $iconColors[$type] }} rounded-full p-3">
                    {{ $icon ?? '' }}
                </div>
            </div>
            <h2 class="text-xl font-bold text-gray-900 text-center mb-2">{{ $title }}</h2>
            <div class="text-gray-600 text-center mb-6">
                {{ $slot }}
            </div>
            {{ $actions ?? '' }}
        </div>
    </div>
</div>