@props([
    'title' => 'Title',
    'icon' => null,
])
<div class="flex items-center justify-between p-4">
    <div class="flex items-center gap-4">
        @if ($icon)
            <x-dynamic-component
                name="icon"
                :component="$icon"
                class="w-4 h-4 text-gray-600 shrink-0"
            />
        @endif
        <x-ui.heading
            level="2"
            size="lg"
        >{{ $title }}</x-ui.heading>
    </div>
    <button
        aria-label="Fechar"
        @click.prevent="isOpen = false"
        class="inline-flex items-center justify-center p-2 text-gray-600 transition duration-150 cursor-pointer hover:text-gray-950 shrink-0 focus:outline-none"
    >
        <x-heroicon-s-x-mark class="w-5 h-5 shrink-0" />
    </button>
</div>
