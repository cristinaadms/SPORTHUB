@props([
    'label' => '',
    'name' => '',
    'required' => false,
    'placeholder' => 'Selecione uma opção',
    'options' => [],
    'selected' => null,
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

    <select id="{{ $name }}" name="{{ $name }}" {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-blue-primary transition-colors bg-white']) }}>
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" {{ old($name, (string) $selected) == (string) $value ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>

    @if ($help)
        <p class="text-xs text-gray-500 mt-1">{{ $help }}</p>
    @endif

    @error($name)
        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>
