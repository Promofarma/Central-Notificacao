@use('\App\Enums\NotificationSendType')

<div
    href="{{ route('notification.show', $notification) }}"
    {!! $attributes->merge([
        'class' => 'bg-white rounded-lg ring-1 ring-gray-200 shadow-sm relative flex flex-col justify-between',
    ]) !!}
>
    <div class="p-4 space-y-4">
        <div class="flex items-center gap-3">
            <div
                class="inline-flex items-center justify-center p-1 rounded-full bg-gradient-to-b from-gray-400/20 to-white size-14">
                <div
                    class="inline-flex items-center justify-center bg-white rounded-full drop-shadow-sm shrink-0 ring-1 ring-gray-200 size-10">
                    <x-dynamic-component
                        component="icon"
                        :name="$notification->send_type->icon()"
                        class="w-6 h-6 text-gray-700 shrink-0"
                    />
                </div>
            </div>
            <div class="space-y-1.5">
                <x-ui.badge
                    color="gray"
                    size="sm"
                >
                    {{ $notification->category->name }}
                </x-ui.badge>
                <x-ui.heading
                    leve="2"
                    size="lg"
                    class="line-clamp-1"
                >
                    {{ $notification->title }}
                </x-ui.heading>
            </div>
        </div>

        <div class="flex flex-wrap justify-between gap-3 text-gray-700">
            <div class="flex gap-4">
                <span class="flex items-center gap-1.5 text-xs">
                    <x-heroicon-s-calendar class="w-4 h-4 text-gray-500" />
                    {{ $notification->formatted_created_at }}
                </span>
                <span class="flex items-center gap-1.5 text-xs">
                    <x-heroicon-s-user class="w-4 h-4 text-gray-500" />
                    {{ $notification->user->name }}
                </span>
            </div>

            <div class="flex gap-4">
                <span class="flex items-center gap-1.5 text-xs">
                    <x-heroicon-s-users class="w-4 h-4 text-gray-500" />
                    {{ $notification->recipients_count }}
                </span>
                <span class="flex items-center gap-1.5 text-xs">
                    <x-heroicon-s-paper-clip class="w-4 h-4 text-gray-500" />
                    {{ $notification->attachments_count }}
                </span>
            </div>
        </div>
    </div>

    <div class="p-4 space-y-3 border-t border-gray-100 rounded-b-lg bg-gray-50">
        <div class="flex items-center gap-3">
            <div class="relative flex-1 h-2 overflow-hidden bg-gray-200 rounded-full">
                <span
                    style="width: {{ $getPercentageRead() }};"
                    class="absolute h-full transition-all duration-300 ease-linear bg-green-500 animate-pulse"
                ></span>
            </div>
            <x-ui.text
                size="xs"
                class="text-gray-600"
            >
                {{ $getPercentageRead() }}
            </x-ui.text>
        </div>

        <div class="flex items-center gap-1.5">
            <x-heroicon-s-information-circle class="w-4 h-4 text-gray-500" />
            <x-ui.text size="xs">
                @if ($notification->send_type === NotificationSendType::SENT)
                    Enviada em {{ $notification->formatted_created_at }}
                @elseif($notification->send_type === NotificationSendType::RECURRING)
                    Recorrente de {{ $notification->schedule->start_date->format('d/m/y') }} até
                    {{ $notification->schedule->end_date->format('d/m/y') }}
                @else
                    Agendada para {{ $notification->scheduled_date->format('d/m/y') }}
                    {{ $notification->scheduled_time ? 'às ' . $notification->scheduled_time->format('H:i') : '' }}
                @endif
            </x-ui.text>
        </div>
    </div>

    <div
        x-data="{ isOpen: false }"
        class="absolute flex items-center gap-2 top-4 right-4"
    >
        <x-ui.badge
            size="sm"
            :color="$notification->send_type->color()"
        >
            {{ $notification->send_type->label() }}
        </x-ui.badge>

        <div class="relative">
            <x-ui.button
                icon="ellipsis-vertical"
                size="sm"
                color="gray"
                @click.prevent="isOpen = !isOpen"
                class="!ring-0 hover:bg-gray-100"
                x-bind:class="{ '!bg-gray-100': isOpen }"
                x-ref="trigger"
                aria-haspopup="true"
                x-bind:aria-expanded="isOpen"
            />

            <div
                x-show="isOpen"
                x-cloak
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                x-anchor.bottom-end.offset.4="$refs.trigger"
                class="absolute z-10 mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 ring-1 ring-gray-200 focus:outline-none"
                role="menu"
                aria-orientation="vertical"
                aria-labelledby="menu-button"
                @click.away="isOpen = false"
            >
                <div class="p-2">
                    <span class="flex items-center gap-1.5">
                        <x-heroicon-s-bolt class="w-4 h-4 text-gray-500" />
                        <x-ui.text size="xs">Ações disponíveis</x-ui.heading>
                    </span>
                </div>
                @can('update', $notification)
                    <div class="p-2 space-y-2">
                        <x-ui.button
                            :href="route('notification.show', $notification)"
                            size="sm"
                            icon="eye"
                            color="gray"
                            full-size
                            class="!justify-start !ring-0 text-slate-600 hover:text-slate-950 hover:!bg-gray-100"
                            role="menuitem"
                        >
                            Visualizar
                        </x-ui.button>

                        <x-ui.button
                            :href="route('notification.edit', $notification)"
                            size="sm"
                            icon="pencil"
                            color="gray"
                            full-size
                            class="!justify-start !ring-0 text-slate-600 hover:text-slate-950 hover:!bg-gray-100"
                            role="menuitem"
                        >
                            Editar
                        </x-ui.button>
                    </div>
                @endcan

                @can('delete', $notification)
                    <div class="p-2">
                        <livewire:notification.delete
                            :notification="$notification"
                            wire:key="{{ $notification->uuid }}"
                        />
                    </div>
                @endcan
            </div>
        </div>
    </div>
</div>
