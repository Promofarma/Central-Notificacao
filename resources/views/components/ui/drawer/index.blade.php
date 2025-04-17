@props([
    'icon' => null,
])
<div
    x-data="{
        isOpen: $wire.entangle('isOpen'),
    }"
    class="relative z-50 w-auto h-auto"
>
    <template x-teleport="body">
        <div
            x-show="isOpen"
            class="relative z-[99]"
            @keydown.window.escape="isOpen = false"
        >
            <div
                x-show="isOpen"
                @click="isOpen = false"
                x-transition.opacity.duration.600ms
                class="fixed inset-0 bg-gray-950/50"
            ></div>
            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="fixed inset-y-0 right-0 flex max-w-full p-4 pl-10">
                        <div
                            x-show="isOpen"
                            @click.away="isOpen = false"
                            x-transition:enter="transform transition ease-in-out duration-150 sm:duration-700"
                            x-transition:enter-start="translate-x-full"
                            x-transition:enter-end="translate-x-0"
                            x-transition:leave="transform transition ease-in-out duration-300 sm:duration-700"
                            x-transition:leave-start="translate-x-0"
                            x-transition:leave-end="translate-x-full"
                            class="w-screen max-w-md"
                        >
                            <div
                                class="flex flex-col h-full gap-4 bg-white rounded-lg shadow-sm ring-1 ring-gray-950/10">
                                <x-ui.drawer.header :icon="$icon">
                                    @isset($title)
                                        <x-slot name="title">
                                            {{ $title }}
                                        </x-slot>
                                    @endisset
                                </x-ui.drawer.header>
                                <x-ui.drawer.body>
                                    {{ $slot }}
                                </x-ui.drawer.body>
                                @isset($footer)
                                    <x-ui.drawer.footer>
                                        {{ $footer }}
                                    </x-ui.drawer.footer>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </template>
</div>
