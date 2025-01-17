<main
    class="relative flex-1 grid overflow-y-auto grid-rows-[auto_1fr] [&::-webkit-scrollbar]:w-1 [&::-webkit-scrollbar-track]:bg-slate-300/50 [&::-webkit-scrollbar-thumb]:bg-slate-400 [&::-webkit-scrollbar-thumb]:rounded-full"
    wire:transition.opacity.duration.200ms
>
    <header
        class="flex items-center justify-between px-3 bg-white border-b shadow-sm h-14 border-slate-200 shadow-slate-300/10"
    >
        <h2 class="text-lg font-bold text-slate-700">
            {{ $notification->title }}
        </h2>
        <div class="flex items-center gap-3">
            <div class="inline-flex items-center gap-1.5 text-green-600">
                @if ($notificationRecipient->isRead())
                    <x-lucide-check-check class="size-3" />
                    <span class="text-xs font-medium">
                        Lida em <strong>{{ $notificationRecipient->read_at }}</strong>
                    </span>
                @endif
            </div>

            <div class="inline-flex items-center gap-1.5 text-slate-400">
                <x-lucide-archive class="size-3" />
                <span class="text-xs font-medium">
                    Arquivada
                </span>
            </div>

            <x-ui.button
                size="small"
                icon="archive"
            >
                Arquivar
            </x-ui.button>

        </div>
    </header>

    <section class="p-6 space-y-6">
        <div class="space-y-1">
            <span class="text-xs font-medium text-slate-400">Enviada por
                <strong>{{ $notification->user->name }}</strong> em
                {{ $notification->formatted_created_at }}</span>
        </div>

        <div class="max-w-full prose">
            {!! $notification->content !!}
        </div>
        @if (filled($attachments = $notification->attachments))
            <div class="grid gap-3">
                <span class="text-sm font-semibold text-slate-700">Anexos:</span>
                <ul class="space-y-2">
                    @foreach ($attachments as $attachment)
                        {{-- <x-notification.attachment-item :$attachment /> --}}
                    @endforeach
                </ul>
            </div>
        @endif
    </section>
</main>
