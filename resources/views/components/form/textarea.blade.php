@props([
    'label' => '',
    'name' => '',
    'required' => false,
    'placeholder' => '',
    'value' => '',
    'rows' => 3,
    'help' => null,
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-2">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    <textarea id="{{ $name }}" name="{{ $name }}" rows="{{ $rows }}" {{ $required ? 'required' : '' }}
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-blue-primary transition-colors resize-none']) }}>{{ old($name, $value) }}</textarea>
    @if ($help)
        <p class="text-xs text-gray-500 mt-1">{{ $help }}</p>
    @endif
    @error($name)
        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>
