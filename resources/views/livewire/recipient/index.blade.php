<main class="flex h-screen">
    <aside
        x-data="{
            tab: $persist('inbox').as('recipient-tab'),
        }"
        class="flex flex-grow max-w-sm border-r border-slate-200"
    >
        <x-recipient.mini-sidebar />
        <x-recipient.sidebar-wrapper
            title="Inbox"
            icon="inbox"
            x-show="tab === 'inbox'"
            x-cloak
        >
            <x-recipient.inbox :$groupedRecipientNotifications />
        </x-recipient.sidebar-wrapper>
        <x-recipient.sidebar-wrapper
            title="Filtros"
            icon="filter"
            x-show="tab === 'filters'"
            x-cloak
        >
            <livewire:recipient.filter />
        </x-recipient.sidebar-wrapper>
    </aside>
    @if ($selectedNotificationUuid)
        <livewire:recipient.show
            :recipient-id="$recipient"
            :notification-uuid="$selectedNotificationUuid"
            wire:key="{{ $selectedNotificationUuid }}"
        />
    @else
        <x-recipient.content />
    @endif
</main>
