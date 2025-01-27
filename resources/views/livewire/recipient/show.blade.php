<section class="flex-1 bg-white">
    <header
        class="flex items-center justify-between h-full px-3 border-b shadow-sm max-h-14 border-slate-200 shadow-slate-300/10"
    >
        <h3 class="text-lg font-bold">{{ $notification->title }}</h3>
        <div class="flex items-center gap-4">
            @if ($notificationRecipient->isRead())
                <span class="inline-flex items-center gap-2 text-slate-500">
                    <x-lucide-check-check class="size-4" />
                    <span class="text-xs font-medium">Lida em
                        {{ $notificationRecipient->readed_at->diffForHumans() }}</span>
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
            title="Enviada por"
            class="space-y-2"
        >
            <div class="prose max-w-none">
                {{ $notification->user->name }}
            </div>
        </x-ui.container>
        <x-ui.container
            title="Conteúdo"
            class="space-y-2"
        >
            <div class="prose max-w-none">
                {!! $notification->content !!}
            </div>
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
