@props([
    'target' => 'tab',
])
<div
    {!! $attributes->merge([
        'class' =>
            'absolute inset-0 z-50 flex-col items-center justify-center w-full h-full px-4 overflow-hidden text-center transition duration-150 pointer-events-auto gap-y-2 bg-gray-50/50 backdrop-blur',
    ]) !!}
    wire:loading.flex
    wire:target="{{ $target }}"
>
    <x-ui.spinner />
    <x-ui.text
        size="xs"
        variant="subtle"
    >
        {{ $slot }}
    </x-ui.text>
</div>
