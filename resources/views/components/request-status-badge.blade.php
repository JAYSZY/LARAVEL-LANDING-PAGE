@props(['status'])

@php
    $config = [
        'pending' => ['classes' => 'bg-amber-50 text-amber-700 ring-amber-200', 'icon' => 'o-clock', 'label' => 'Pending'],
        'reviewing' => ['classes' => 'bg-blue-50 text-blue-700 ring-blue-200', 'icon' => 'o-arrow-path', 'label' => 'Reviewing'],
        'approved' => ['classes' => 'bg-green-50 text-green-700 ring-green-200', 'icon' => 's-check-circle', 'label' => 'Approved'],
        'denied' => ['classes' => 'bg-red-50 text-red-700 ring-red-200', 'icon' => 's-x-circle', 'label' => 'Denied'],
    ];

    $style = $config[$status] ?? ['classes' => 'bg-gray-50 text-gray-700 ring-gray-200', 'icon' => 'o-question-mark-circle', 'label' => ucfirst($status)];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset ' . $style['classes']]) }}>
    <x-dynamic-component :component="'heroicon-' . $style['icon']" class="h-3.5 w-3.5 shrink-0" />
    {{ $style['label'] }}
</span>
