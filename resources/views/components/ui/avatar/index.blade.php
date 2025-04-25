@props([
    'initials' => null,
    'size' => 'default',
])
<span {!! $attributes->class([
        'w-6 h-6' => $size === 'xs',
        'w-8 h-8' => $size === 'sm',
        'w-10 h-10' => $size === 'default',
        'w-12 h-12' => $size === 'lg',
    ])->merge([
        'class' =>
            'flex items-center justify-center text-xs font-medium text-primary-800 bg-primary-200 rounded-full select-none',
    ]) !!}>
    {{ $initials ?? '' }}
</span>
