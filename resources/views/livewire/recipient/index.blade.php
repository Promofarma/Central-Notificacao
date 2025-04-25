<div class="relative flex h-screen">
    <aside class="flex flex-auto max-w-2xl border-r divide-x divide-gray-950/10 border-gray-950/10">
        <x-recipient-v2.mini-sidebar :recipient="$recipient" />

        <x-recipient-v2.categories :categories="$this->categories" />


        @if ($tab === 'inbox')
            <x-recipient-v2.inbox
                title="Caixa de Entrada"
                icon="heroicon-s-inbox"
                :notifications="$this->notificationRecipients"
            />
        @endif

        @if ($tab === 'archived')
            <x-recipient-v2.inbox
                title="Arquivadas"
                icon="heroicon-s-archive-box"
                :notifications="$this->notificationRecipients"
            />
        @endif
    </aside>

    @if (filled($notification) && Str::isUuid($notification))
        <livewire:recipient.show
            :id="$recipient"
            :uuid="$notification"
            wire:key="selected-notification-{{ $notification }}"
        />
    @else
        <x-recipient-v2.content />
    @endif

    <livewire:recipient.modal.achievement />

    <livewire:recipient.drawer.filter />
</div>
