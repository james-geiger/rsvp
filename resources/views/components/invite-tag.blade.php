@props(['type'])

@php
switch($type)
{
  case "Pending":
    $classes = 'inline-flex items-center rounded-md px-2.5 py-0.5 text-sm font-medium text-gray-800 bg-gray-100';
    $color = 'text-gray-400';
    break;
  case "Accepted":
    $classes = 'inline-flex items-center rounded-md px-2.5 py-0.5 text-sm font-medium text-green-800 bg-green-100';
    $color = 'text-green-400';
    break;
  case "Declined":
    $classes = 'inline-flex items-center rounded-md px-2.5 py-0.5 text-sm font-medium text-red-800 bg-red-100';
    $color = 'text-red-400';
    break;
}
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
<svg class="-ml-0.5 mr-1.5 h-2 w-2" class="{{ $color }}" fill="currentColor" viewBox="0 0 8 8">
    <circle cx="4" cy="4" r="3" />
  </svg>
    {{ $slot }}
</span>
