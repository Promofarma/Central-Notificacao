<main class="flex-1 overflow-y-auto">
    <div class="sticky inset-0 top-0 bg-white">
        <header class="flex items-center justify-between px-4 border-b h-14 border-gray-950/10">
            <x-ui.button
                :href="route('recipient', [
                    'recipient' => $recipient->recipient_id,
                    'category' => $notification->category_id,
                ])"
                text="Voltar"
                icon="arrow-left"
                color="gray"
                size="sm"
            />
            <div class="flex items-center gap-x-4">
                @if ($recipient->isArchived())
                    <x-ui.badge
                        icon="heroicon-m-archive-box"
                        size="sm"
                    >
                        Arquivada
                    </x-ui.badge>
                @else
                    <livewire:recipient.archive
                        :recipient="$recipient"
                        wire:key="archive-recipient-{{ $recipient->id }}"
                    />
                @endif

                @if ($recipient->isRead())
                    <span class="block w-px h-6 bg-gray-950/10"></span>
                    <x-ui.badge
                        icon="heroicon-m-envelope-open"
                        size="sm"
                        color="success"
                    >
                        Lida
                    </x-ui.badge>
                @endif
            </div>
        </header>
        <div class="flex items-center justify-between p-4 border-b border-gray-950/10">
            <x-ui.heading>
                {{ $notification->title }}
            </x-ui.heading>

            <div class="shrink-0">
                <x-ui.text
                    size="sm"
                    variant="subtle"
                    title="Enviada em {{ $notification->formatted_created_at }}"
                    @mouseenter="on = true"
                >
                    {{ $notification->created_at->diffForHumans() }}
                </x-ui.text>
            </div>

        </div>
    </div>

    <div
        x-data="{ expanded: true }"
        class="p-4"
    >
        <div class="flex items-center mb-4 gap-x-4">
            <x-ui.avatar
                size="sm"
                :initials="$notification->user->initials()"
            />
            <div class="space-y-1">
                <x-ui.heading level="4">
                    {{ $notification->user->name }}
                </x-ui.heading>
                <x-ui.text
                    size="xs"
                    variant="subtle"
                >
                    {{ $notification->user->email }}
                </x-ui.text>
            </div>
        </div>

        <div
            class="prose-sm prose prose-gray max-w-none"
            x-bind:class="{ 'line-clamp-3': !expanded }"
            x-cloak
            x-ref="content"
        >
            {!! $notification->content !!}
        </div>

        <button
            class="inline-block text-sm font-medium text-gray-500 transition-colors duration-150 hover:text-primary-700"
            x-on:click="expanded = ! expanded"
            x-show="! expanded && {{ strlen($notification->getRawContent()) }} > 100"
            x-cloak
        >...mais</button>

        @if (filled($attachments = $notification->attachments))
            <div class="mt-4">
                <x-notification.attachment.viewer :$attachments />
            </div>
        @endif
    </div>
</main>
