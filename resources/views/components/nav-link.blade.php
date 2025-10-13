{{-- @props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a> --}}
@props(['active'])

@php
$baseClasses = 'inline-flex items-center px-3 py-2 rounded-md text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none';

$activeClasses = 'bg-white text-red-800'; // Style untuk link aktif

$inactiveClasses = 'text-gray-200 hover:bg-red-700 hover:text-white focus:text-white focus:bg-red-700'; // Style untuk link tidak aktif
@endphp

<a {{ $attributes->merge(['class' => $baseClasses . ' ' . ($active ? $activeClasses : $inactiveClasses)]) }}>
    {{ $slot }}
</a>
