@props([
    'icon' => null,
    'color' => 'primary',
])

<span {!! $attributes->class([
        'bg-slate-400/20 text-slate-700 group-data-[hover]:bg-slate-400/30' => $color === 'white',
        'bg-primary-400/20 text-primary-700 group-data-[hover]:bg-primary-400/30' => $color === 'primary',
        'bg-green-400/20 text-green-700 group-data-[hover]:bg-green-400/30' => $color === 'success',
        'bg-red-400/20 text-red-700 group-data-[hover]:bg-red-400/30' => $color === 'danger',
        'bg-amber-400/20 text-amber-700 group-data-[hover]:bg-amber-400/30' => $color === 'warning',
        'bg-sky-400/20 text-sky-700 group-data-[hover]:bg-sky-400/30' => $color === 'info',
    ])->merge([
        'class' =>
            'inline-flex items-center gap-x-1.5 rounded-lg px-1.5 py-0.5 text-sm/5 font-medium sm:text-xs/5 forced-colors:outline [&>svg]:size-3',
    ]) !!}>
    @if ($icon)
        <x-dynamic-component
            name="icon"
            component="lucide-{{ $icon }}"
        />
    @endif
    {{ $slot }}
</span>
