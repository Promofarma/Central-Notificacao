<section class="flex flex-col flex-1">
    <header
        class="flex items-center justify-between h-full gap-3 px-4 border-b border-gray-200 shadow-sm shrink-0 max-h-14 shadow-gray-300/10"
    >
        @if ($notificationRecipient->isArchived())
            <span class="inline-flex items-center gap-1.5">
                <x-heroicon-m-archive-box class="text-gray-500 size-4" />
                <x-ui.text size="xs">Arquivada</x-ui.text>
            </span>
        @else
            <livewire:recipient.archive
                :notification-recipient="$notificationRecipient"
                :wire:key="$notificationRecipient->id"
            />
        @endif
        <div class="flex items-center gap-3">
            @if ($notificationRecipient->isRead())
                <x-ui.badge
                    icon="heroicon-m-check"
                    color="success"
                >
                    Lida {{ $notificationRecipient->readed_at->diffForHumans() }}
                </x-ui.badge>
            @endif
            <x-ui.badge color="gray">{{ $notification->category->name }}</x-ui.badge>
        </div>
    </header>
    <div class="flex items-start justify-between p-4 shrink-0">
        <div class="flex items-start">
            <div class="flex items-start gap-4 text-sm">
                <span class="relative flex w-10 h-10 overflow-hidden rounded-full shrink-0">
                    <span class="flex items-center justify-center w-full h-full bg-gray-200 rounded-full">
                        {{ $notification->user->name[0] }}
                    </span>
                </span>
                <div class="grid gap-1">
                    <div class="font-semibold">{{ $notification->user->name }}</div>
                    <div class="text-xs line-clamp-1">{{ $notification->title }}</div>
                </div>
            </div>
        </div>
        <div class="ml-auto text-xs text-gray-400">{{ $notification->formatted_created_at }}</div>
    </div>
    <div class="flex-1 h-px space-y-4 overflow-y-auto">
        <div class="p-4 prose whitespace-normal prose-gray max-w-none">
            {!! html_entity_decode($notification->content) !!}
        </div>
        @if (filled($attachments = $notification->attachments))
            <x-notification.attachment.viewer :$attachments />
        @endif
    </div>
</section>
