@props(['icon', 'value', 'label' => null])

<div class="flex items-center space-x-3">
    <div class="bg-blue-light p-2 rounded-xl">
        <x-dynamic-component :component="'icons.' . $icon" class="w-5 h-5 text-blue-primary" />
    </div>
    <div>
        @if ($label)
            <p class="text-sm text-gray-secondary">{{ $label }}</p>
        @endif
        <p class="font-semibold text-gray-900">{{ $value }}</p>
    </div>
</div>
