@props([
    'size' => 'default',
    'color' => 'gray',
    'icon' => null,
    'variant' => null,
])

<span @class([
    'py-1 text-xs' => $size === 'sm',
    'py-1 text-sm' => $size === 'default',
    'py-1.5 text-sm' => $size === 'lg',
    'text-primary-700 bg-primary-400/20' => $color === 'primary',
    'text-green-700 bg-green-400/20' => $color === 'success',
    'text-amber-700 bg-amber-400/20' => $color === 'warning',
    'text-blue-700 bg-blue-400/20' => $color === 'info',
    'text-red-700 bg-red-400/20' => $color === 'danger',
    'text-gray-700 bg-gray-400/20' => $color === 'gray',
    'rounded-full px-3' => $variant === 'pill',
    'rounded-md px-2' => blank($variant),
    'font-medium whitespace-nowrap inline-flex items-center justify-center [&>svg]:size-4 [&>svg]:shrink-0',
])>
    @if ($icon)
        <x-dynamic-component
            component="icon"
            :name="$icon"
            class="me-1.5"
        />
    @endif

    <span>{{ $slot }}</span>
</span>
