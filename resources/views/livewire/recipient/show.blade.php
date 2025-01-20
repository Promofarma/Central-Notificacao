<section class="flex-1">
    <header
        class="flex items-center justify-between h-full px-3 bg-white border-b shadow-sm max-h-14 border-slate-200 shadow-slate-300/10"
    >
        <h3 class="text-lg font-bold">{{ $notification->title }}</h3>
        <div class="flex items-center gap-4">
            @if ($notificationRecipient->isRead())
                <span class="inline-flex items-center gap-2 text-green-600">
                    <x-lucide-check-check class="size-4" />
                    <span class="text-xs font-medium">Lida em
                        {{ $notificationRecipient->read_at->diffForHumans() }}</span>
                </span>
            @endif

            @if ($notificationRecipient->isArchived())
                <span class="inline-flex items-center gap-2 text-slate-600">
                    <x-lucide-archive class="size-4" />
                    <span class="text-xs font-medium">Arquivada</span>
                </span>
            @else
                <livewire:recipient.archive
                    :notification-recipient="$notificationRecipient"
                    :wire:key="$notificationRecipient->id"
                />
            @endif
        </div>
    </header>
    <div class="p-3 space-y-4">
        <x-ui.container
            title="Conteúdo"
            class="space-y-2"
        >
            {!! $notification->content !!}
        </x-ui.container>

        @if ($notification->attachments->isNotEmpty())
            <x-ui.container
                title="Anexos"
                class="space-y-2"
            >
                @foreach ($notification->attachments as $attachment)
                    <x-notification.attachment.item :attachment="$attachment" />
                @endforeach
            </x-ui.container>
        @endif
    </div>
</section>
