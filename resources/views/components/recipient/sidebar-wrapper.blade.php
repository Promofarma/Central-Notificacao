@props([
    'title' => null,
    'icon' => null,
])
<div {!! $attributes->merge(['class' => 'flex flex-col flex-1 bg-gray-50']) !!}>
    <div
        class="flex items-center h-full gap-3 px-4 py-3 border-b border-gray-200 shadow-md max-h-14 shrink-0 shadow-gray-300/10">
        @if ($icon)
            <x-dynamic-component
                name="icon"
                :component="$icon"
                class="text-gray-500 size-5"
            />
        @endif
        <x-ui.heading
            level="3"
            size="lg"
        >
            {{ $title }}
        </x-ui.heading>
    </div>
    {{ $slot }}
</div>
