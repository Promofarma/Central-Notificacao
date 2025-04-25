@props([
    'title' => 'Inbox',
    'icon' => null,
    'notifications' => [],
])
<div {!! $attributes->merge(['class' => 'relative bg-gray-50/25 flex flex-col flex-1']) !!}>
    <div class="flex items-center px-4 gap-x-1.5 border-b shrink-0 h-14 border-gray-950/10">
        @if ($icon)
            <x-dynamic-component
                name="icon"
                :component="$icon"
                class="w-5 h-5 text-gray-500 shrink-0"
            />
        @endif
        <x-ui.heading level="4">
            {{ $title }}
        </x-ui.heading>
    </div>
    <div
        class="relative flex-1 h-px overflow-y-auto scroll-smooth"
        wire:loading.class="overflow-y-clip"
        wire:target="tab, category"
    >
        @forelse ($notifications as $recipient)
            <x-recipient-v2.inbox.notification.item
                :recipient="$recipient"
                :notification="$recipient->notification"
                wire:loading.attr="data-loading"
                wire:key="notification-recipient-{{ $recipient->id }}"
            />
        @empty
            <div class="pt-4">
                <x-ui.empty-state>
                    <x-slot:icon>
                        <x-heroicon-s-inbox class="w-5 h-5 text-gray-500 shrink-0" />
                    </x-slot:icon>
                    <x-slot:title>
                        Nada por aqui ainda. Escolha uma categoria ao lado para ver notificações
                    </x-slot:title>
                </x-ui.empty-state>
            </div>
        @endforelse

        @if (filled($notifications))
            <x-recipient-v2.tab.loading-overlay target="tab, category">
                Carregando notificações, por favor, aguarde...
            </x-recipient-v2.tab.loading-overlay>
        @endif
    </div>
</div>
