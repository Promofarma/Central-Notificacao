<x-filament-notifications::notification
    :notification="$notification"
    class="relative w-full max-w-sm p-4 overflow-hidden bg-white rounded-lg shadow-md pointer-events-auto shadow-slate-900/5 ring-1 ring-slate-400/10"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-x-4"
    x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 translate-x-4"
>
    <!-- Container -->
    <div @class(['flex gap-3', 'items-center' => blank($getBody())])>
        @if (filled($icon = $getIcon()))
            <!-- Icon -->
            <div class="inline-flex items-center justify-center rounded-full shrink-0 size-8 bg-slate-100">
                <x-dynamic-component
                    name="icon"
                    :component="$icon"
                    class="stroke-slate-600 size-4"
                />
            </div>
            <!-- Icon -->
        @endif
        <div class="flex-1 space-y-1">
            <h4 class="text-sm font-semibold">
                {{ $getTitle() }}
            </h4>
            <p class="text-sm text-slate-500">
                {{ $getBody() }}
            </p>
        </div>
    </div>
    <!-- Container -->

    <!-- Close Button -->
    <button
        aria-label="Fechar notificação"
        class="absolute inline-flex items-center justify-center p-1 text-sm transition rounded-full text-slate-500 hover:text-slate-900 hover:bg-slate-100 focus:outline-none right-2 top-2"
        x-on:click="close"
    >
        <x-lucide-x class="size-4" />
    </button>
    <!-- Close Button -->
</x-filament-notifications::notification>
