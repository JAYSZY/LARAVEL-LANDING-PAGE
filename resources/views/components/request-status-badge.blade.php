@props(['status'])

@php
    $styles = [
        'pending' => 'bg-amber-100 text-amber-800',
        'contacted' => 'bg-blue-100 text-blue-800',
        'approved' => 'bg-green-100 text-green-800',
        'declined' => 'bg-red-100 text-red-800',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold capitalize ' . ($styles[$status] ?? 'bg-gray-100 text-gray-800')]) }}>
    {{ $status }}
</span>
