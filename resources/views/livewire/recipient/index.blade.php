<main class="flex h-screen">
    <aside
        x-data="{
            tab: $persist('inbox').as('recipient-tab'),
        }"
        class="flex flex-grow max-w-md border-r border-gray-200"
    >
        <x-recipient.mini-sidebar :recipient-id="$recipientId" />
        <x-recipient.sidebar-wrapper
            title="Caixa de Entrada"
            icon="heroicon-s-inbox"
            x-show="tab === 'inbox'"
            x-cloak
        >
            <x-recipient.inbox :notification-recipient-items="$unarchivedNotificationRecipients" />
        </x-recipient.sidebar-wrapper>
        <x-recipient.sidebar-wrapper
            title="Arquivadas"
            icon="heroicon-s-archive-box"
            x-show="tab === 'archived'"
            x-cloak
        >
            <x-recipient.inbox :notification-recipient-items="$archivedNotificationRecipients" />
        </x-recipient.sidebar-wrapper>
        <x-recipient.sidebar-wrapper
            title="Filtros"
            icon="heroicon-s-funnel"
            x-show="tab === 'filters'"
            x-cloak
        >
            <livewire:recipient.filter />
        </x-recipient.sidebar-wrapper>
    </aside>
    @if ($selected)
        <livewire:recipient.show
            :notification-uuid="$selected"
            :recipient-id="$recipientId"
            :wire:key="$selected"
        />
    @else
        <x-recipient.content :categories="$categories" />
    @endif
</main>
