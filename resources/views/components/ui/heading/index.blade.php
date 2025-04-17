@props([
    'size' => 'base',
    'level' => 1,
])

@php
    $tag = match ($level) {
        1 => 'h1',
        2 => 'h2',
        3 => 'h3',
        default => 'div',
    };
@endphp

<{{ $tag }} {!! $attributes->class([
        'text-sm' => $size === 'base',
        'text-base' => $size === 'lg',
        'text-2xl' => $size === 'xl',
    ])->merge(['class' => 'tracking-tight font-semibold']) !!}>
    {{ $slot }}

    </{{ $tag }}>
