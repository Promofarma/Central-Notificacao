<x-filament-notifications::notification
    :notification="$notification"
    class="relative w-full max-w-sm p-4 overflow-hidden bg-white rounded-lg shadow-sm pointer-events-auto ring-1 shadow-black-900/5 ring-gray-200"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 trangray-x-4"
    x-transition:enter-end="opacity-100 trangray-x-0"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 trangray-x-0"
    x-transition:leave-end="opacity-0 trangray-x-4"
>
    <div @class(['flex gap-3', 'items-center' => blank($getBody())])>
        @if (filled($icon = $getIcon()))
            <div class="inline-flex items-center justify-center bg-gray-100 rounded-full shrink-0 size-8">
                <x-dynamic-component
                    name="icon"
                    :component="$icon"
                    class="text-gray-600 size-5"
                />
            </div>
        @endif
        <div class="flex-1 space-y-1">
            <x-ui.heading>{{ $getTitle() }}</x-ui.heading>
            <x-ui.text
                size="xs"
                variant="subtle"
            >{{ $getBody() }}</x-ui.text>
        </div>
    </div>
    <button
        aria-label="Fechar notificação"
        class="absolute inline-flex items-center justify-center p-1 text-sm text-gray-500 transition rounded-full hover:text-gray-900 hover:bg-gray-100 focus:outline-none right-2 top-2"
        x-on:click="close"
    >
        <x-heroicon-s-x-mark class="size-4 shrink-0" />
    </button>
</x-filament-notifications::notification>
