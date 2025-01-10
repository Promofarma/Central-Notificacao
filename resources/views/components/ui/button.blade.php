@php
    $textOrSlot = $text ?? (isset($slot) ? $slot : null);
@endphp
<{{ $getTag() }}
    {{ $attributes->class([
            'px-2 py-[0.188rem] text-xs' => $size === 'small',
            'px-3 py-[0.313rem] text-sm font-semibold' => $size === 'medium',
            'px-4 py-2 text-base font-semibold' => $size === 'large',
            'bg-white border border-slate-200 active:bg-slate-200 text-slate-900 hover:bg-slate-50' => $color === 'white',
            'bg-primary-500 text-white active:bg-primary-700 hover:bg-primary-600' => $color === 'primary',
            'bg-green-500 text-white active:bg-green-700 hover:bg-green-600' => $color === 'success',
            'bg-red-500 text-white active:bg-red-700 hover:bg-red-600' => $color === 'danger',
            'bg-amber-500 text-white active:bg-amber-700 hover:bg-amber-600' => $color === 'warning',
            'bg-sky-500 text-white active:bg-sky-700 hover:bg-sky-600' => $color === 'info',
            'rounded' => $shape === 'rounded',
            'rounded-full' => $shape === 'circular',
            'gap-2' => $icon && $textOrSlot != '',
            'flex-row-reverse' => $iconPosition === 'after',
            'w-full' => $fullSize,
            'max-w-max' => !$fullSize,
        ])->merge(
            array_merge($getTagAttributes(), [
                'class' =>
                    'flex items-center cursor-pointer justify-center overflow-hidden text-center align-middle transition duration-150 disabled:opacity-60 focus:outline-none',
            ]),
        ) }}
>
    @if ($icon)
        <!-- Icon -->
        <x-dynamic-component
            component="icon"
            :name="$getIcon()"
            class="stroke-current {{ $getIconSize() }}"
            wire:loading.remove
            wire:target="{{ $wireTarget }}"
        />
        <!-- Icon -->
    @endif
    <!-- Text or Slot -->
    <x-lucide-loader
        class="stroke-current animate-spin {{ $getIconSize() }}"
        wire:loading
        wire:target="{{ $wireTarget }}"
    />
    <span
        @if ($wireTarget) wire:target="{{ $wireTarget }}" wire:loading.remove @endif>{{ $textOrSlot }}</span>
    <!-- Text or Slot -->
    </{{ $getTag() }}>
