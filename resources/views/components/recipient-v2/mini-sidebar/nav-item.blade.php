@props([
    'text' => 'Text',
    'icon' => null,
    'count' => null,
])
<button {!! $attributes->merge(['class' => 'p-1 space-y-2 cursor-pointer focus:outline-none group']) !!}>
    <div
        class="relative inline-flex items-center justify-center text-gray-500 transition-colors duration-150 bg-gray-100 rounded-full w-11 h-11 [[data-active]>&]:bg-primary-400/20 [[data-active]>&]:text-primary-700 group-hover:bg-primary-400/20 group-hover:text-primary-700">
        @if ($icon)
            <x-dynamic-component
                name="icon"
                :component="$icon"
                class="w-5 h-5 shrink-0"
            />
        @endif

        @if ($count)
            <span
                class="absolute -top-1.5 w-7 py-0.5 px-1.5 inline-flex items-center justify-center text-xs whitespace-nowrap text-white rounded-full -right-1.5 pointer-events-none bg-primary-600"
            >{{ $count }}</span>
        @endif
    </div>
    <x-ui.text
        size="xs"
        variant="subtle"
        class="[[data-active]>&]:text-gray-950"
    >
        {{ $text }}
    </x-ui.text>
</button>
