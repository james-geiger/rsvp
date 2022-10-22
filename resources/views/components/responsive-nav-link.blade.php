@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block px-3 py-2 font-medium text-gray-900 rounded-md bg-gray-100'
            : 'block px-3 py-2 font-medium text-gray-900 rounded-md hover:bg-gray-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>