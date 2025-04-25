@props([
    'size' => 'base',
    'inline' => false,
    'variant' => 'default',
])

@php
    $tag = $inline ? 'span' : 'p';
@endphp

<{{ $tag }} {!! $attributes->class([
        'text-xs' => $size === 'xs',
        'text-sm' => $size === 'sm',
        'text-base' => $size === 'base',
        'text-gray-500' => $variant === 'subtle',
        'text-gray-600' => $variant === 'default',
        'text-gray-700' => $variant === 'strong',
    ])->merge(['class' => 'font-medium']) !!}>
    {{ $slot }}
    </{{ $tag }}>
