@props(['title'])

<div class="border-b border-gray-200 pb-6">
    <h2 class="text-lg font-semibold text-gray-900 mb-4">{{ $title }}</h2>
    <div class="space-y-4">
        {{ $slot }}
    </div>
</div>
