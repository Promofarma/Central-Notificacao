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
    <div class="space-y-4">
        <div class="flex items-start justify-between p-3 border-b border-slate-200">
            <div class="flex items-center gap-3">
                <div
                    class="inline-flex items-center justify-center text-sm font-bold text-white rounded-lg size-9 bg-slate-600">
                    {{ $notification->user->name[0] }}
                </div>
                <div>
                    <h3 class="text-sm font-bold">{{ $notification->user->name }}</h3>
                    <span class="text-xs font-medium text-slate-400">{{ $notification->user->email }}</span>
                </div>
            </div>
            <span class="text-xs font-medium text-slate-500">
                {{ $notification->formatted_created_at }}
            </span>
        </div>
        <div class="p-3 prose max-w-none">
            {!! $notification->content !!}
        </div>

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
