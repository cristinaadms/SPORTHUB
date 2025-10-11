@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'required' => false,
    'placeholder' => '',
    'value' => '',
    'help' => null,
    'current' => null, // prop para imagem existente
])

<div>
    {{-- Label --}}
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-2">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    {{-- Imagem atual (apenas para type="file") --}}
    @if ($type === 'file' && $current)
        <div class="mb-4">
            <p class="text-sm font-medium text-gray-700 mb-2">Imagem atual:</p>
            <div class="relative w-full h-48 bg-gray-100 rounded-xl overflow-hidden">
                <img src="{{ $current }}" alt="Imagem atual" class="w-full h-full object-cover">
            </div>
        </div>
    @endif

    {{-- Input --}}
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}"
        value="{{ old($name, $value) }}" {{ $required ? 'required' : '' }} placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' =>
                'w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-colors',
        ]) }}
        @if ($type === 'file') onchange="previewImage(event)" @endif>

    {{-- Help text --}}
    @if ($help)
        <p class="text-xs text-gray-500 mt-1">{!! $help !!}</p>
    @endif

    {{-- Erro de validação --}}
    @error($name)
        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>
