@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-[#0b1530]']) }}>
    {{ $value ?? $slot }}
</label>
