@props(['active'])

@php
$classes = ($active ?? false)
            ? 'bg-gray-100 px-3 py-2 rounded-md text-sm font-medium text-gray-900'
            : 'hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium text-gray-900';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
