@use('App\Enums\NotificationSendType')
@props(['recipient', 'notification'])
<a
    href="javascript:void(0)"
    {{ $attributes->merge(['class' => 'flex gap-4 p-4 hover:bg-white transition duration-150 border-b border-gray-950/10 last:border-0 active:bg-transparent data-[loading]:pointer-events-none data-[loading]:animate-pulse']) }}
    x-bind:class="$wire.notification === '{{ $notification->uuid }}' ? 'bg-white' : 'opacity-75'"
    @click.prevent="$wire.notification === '{{ $notification->uuid }}' ? false :  $wire.set('notification', '{{ $notification->uuid }}')"
    title="{{ $notification->title }}"
>
    <div class="relative flex-none">
        <x-ui.avatar
            size="sm"
            :initials="$notification->user->initials()"
        />
    </div>
    <div class="grow">
        <div class="flex items-center justify-between mb-1">
            <x-ui.text
                size="sm"
                class="text-sm font-medium line-clamp-1"
            >
                {{ $notification->user->name }}
            </x-ui.text>
            <div class="self-start flex-none">
                <x-ui.text
                    size="xs"
                    variant="subtle"
                >
                    @if (!$recipient->isViewed() && !$recipient->isRead())
                        <span class="text-lg text-green-500">&bullet;</span>
                    @endif
                    {{ filled($notification->scheduled_date) ? $notification->scheduled_datetime->diffForHumans() : $notification->created_at->diffForHumans() }}
                </x-ui.text>
            </div>
        </div>
        <div class="whitespace-normal max-w-56">
            <x-ui.heading
                level="3"
                class="mb-1 line-clamp-1"
            >
                {{ $notification->title }}
            </x-ui.heading>

            <x-ui.text
                size="xs"
                class="line-clamp-2"
            >
                {{ $notification->getRawContent() }}
            </x-ui.text>
        </div>
        <div class="flex mt-1.5 items-center gap-x-1.5 justify-end [&>svg]:shrink-0">
            @if ($recipient->isArchived())
                <x-heroicon-m-archive-box
                    class="w-4 h-4 text-gray-400"
                    title="Arquivada"
                />
            @endif

            @if ($notification->attachments_count)
                <x-heroicon-m-paper-clip
                    class="w-4 h-4 text-gray-400"
                    title="{{ $notification->attachments_count }} {{ Str::plural('Anexo', $notification->attachments_count) }}"
                />
            @endif

            @if ($recipient->isViewed() && !$recipient->isRead())
                <x-heroicon-o-check-circle
                    class="w-4 h-4 text-gray-400"
                    title="Vista mas não lida"
                />
            @endif

            @if (!$recipient->isViewed() && $recipient->isRead())
                <x-heroicon-o-check-circle
                    class="w-4 h-4 text-amber-600"
                    title="Não vista mas lida"
                />
            @endif

            @if ($recipient->isViewed() && $recipient->isRead())
                <x-heroicon-m-check-circle
                    class="w-4 h-4 text-green-600"
                    title="Vista e lida"
                />
            @endif
        </div>
    </div>
</a>
