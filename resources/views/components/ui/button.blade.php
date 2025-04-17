@php
    $textOrSlot = $text ?? (isset($slot) ? $slot : null);
@endphp
<{{ $getTag() }} {!! $attributes->class([
        'px-2 h-6 text-xs' => $size === 'sm',
        'px-3 h-8 text-sm' => $size === 'default',
        'px-4 text-base h-10' => $size === 'lg',
        'bg-white ring-1 shadow-xs ring-gray-950/10 text-gray-950 hover:bg-gray-50 active:bg-gray-100/75' =>
            $color === 'gray',
        'bg-primary-600 text-white hover:bg-primary-700 active:bg-primary-800' => $color === 'primary',
        'bg-green-500 text-white hover:bg-green-600 active:bg-green-800' => $color === 'success',
        'bg-red-500 text-white hover:bg-red-600 active:bg-red-800' => $color === 'danger',
        'bg-amber-500 text-white hover:bg-amber-600 active:bg-amber-800' => $color === 'warning',
        'bg-sky-500 text-white hover:bg-sky-600 active:bg-sky-800' => $color === 'info',
        'rounded' => $shape === 'rounded',
        'rounded-full' => $shape === 'circular',
        'w-full' => $fullSize,
        'max-w-max' => !$fullSize,
    ])->merge(
        array_merge($getTagAttributes(), [
            'class' =>
                'relative flex items-center cursor-pointer justify-center whitespace-nowrap overflow-hidden text-center tracking-wide font-medium align-middle transition duration-75 focus:outline-none disabled:pointer-events-none disabled:opacity-75 data-[loading]:opacity-75 data-[loading]:pointer-events-none',
        ]),
    ) !!}>
    <div @class([
        'flex items-center gap-2' => $icon && $textOrSlot != '',
        'flex-row-reverse' => $iconPosition === 'after',
        '[[data-loading]>&]:opacity-0',
    ])>
        @if ($icon)
            <x-dynamic-component
                component="icon"
                :name="$getIcon()"
                class="stroke-current {{ $getIconSize() }}"
            />
        @endif
        {{ $textOrSlot }}
    </div>

    <div class="[[data-loading]>&]:opacity-100 opacity-0 absolute inset-0 flex items-center justify-center">
        <x-ui.spinner />
    </div>
    </{{ $getTag() }}>
