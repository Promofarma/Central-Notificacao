<x-ui.page
    :$title
    :$headerActions
>
    <x-slot:sub-header>
        <div class="flex items-center w-full gap-3 py-2 mx-auto md:max-w-sm">
            <x-lucide-info class="size-4 stroke-slate-500" />
            <p class="text-xs font-medium text-slate-500">
                Criado por: <strong>{{ $notification->user->name }}</strong> em
                <strong>{{ $notification->formatted_created_at }}</strong>
            </p>
        </div>
    </x-slot:sub-header>
    <div class="space-y-6">
        <x-ui.container title="Conteúdo">
            <div class="prose max-w-none prose-slate">
                {!! $notification->content !!}
            </div>
        </x-ui.container>

        @if ($notification->attachments->isNotEmpty())
            <x-ui.container title="Anexos">
                <div class="grid grid-cols-2 gap-3">
                    @foreach ($notification->attachments as $attachment)
                        <x-notification.attachment.item :$attachment />
                    @endforeach
                </div>
            </x-ui.container>
        @endif

        <x-ui.container title="Destinatários">
            <div class="flex flex-wrap items-center gap-3">
                @foreach ($notification->recipients as $recipient)
                    <x-notification.recipient.item :$recipient />
                @endforeach
            </div>
        </x-ui.container>
    </div>
</x-ui.page>
