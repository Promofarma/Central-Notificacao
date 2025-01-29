<x-filament-notifications::notification
    :notification="$notification"
    class="relative w-full max-w-sm p-4 overflow-hidden bg-white border rounded-lg shadow-sm pointer-events-auto shadow-slate-900/5 border-slate-200"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-x-4"
    x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 translate-x-4"
>
    <div @class(['flex gap-3', 'items-center' => blank($getBody())])>
        @if (filled($icon = $getIcon()))
            <div class="inline-flex items-center justify-center rounded-full shrink-0 size-8 bg-slate-100">
                <x-dynamic-component
                    name="icon"
                    :component="$icon"
                    class="stroke-slate-600 size-5"
                />
            </div>
        @endif
        <div class="flex-1 space-y-1">
            <h4 class="text-sm font-semibold text-slate-600">
                {{ $getTitle() }}
            </h4>
            <p class="text-xs text-slate-500">
                {{ $getBody() }}
            </p>
        </div>
    </div>
    <button
        aria-label="Fechar notificação"
        class="absolute inline-flex items-center justify-center p-1 text-sm transition rounded-full text-slate-500 hover:text-slate-900 hover:bg-slate-100 focus:outline-none right-2 top-2"
        x-on:click="close"
    >
        <x-lucide-x class="size-4" />
    </button>
</x-filament-notifications::notification>
