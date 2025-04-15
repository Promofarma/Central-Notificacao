@props(['group' => null])

<div
    {!! $attributes->merge([
        'class' =>
            'bg-white rounded-lg p-5 ring-1 ring-gray-200 shadow-sm relative flex flex-col items-center text-center gap-y-4',
    ]) !!}
    @click.away="isOpen = false"
>
    <div
        class="inline-flex items-center justify-center p-1 rounded-full bg-gradient-to-b from-gray-400/20 to-white size-16">
        <div
            class="inline-flex items-center justify-center bg-white rounded-full drop-shadow-sm shrink-0 ring-1 ring-gray-200 size-11">
            <x-heroicon-s-user-group class="w-6 h-6 text-gray-600" />
        </div>
    </div>
    <div class="space-y-1.5">
        <x-ui.heading
            level="2"
            class="text-base font-semibold text-gray-800"
        >
            {{ $group->name }}
        </x-ui.heading>
        <x-ui.text
            size="sm"
            class="text-gray-600"
        >
            {{ $group->recipients_count }} {{ Str::plural('membro', $group->recipients_count) }}
        </x-ui.text>
    </div>

    @if ($group->recipients->isNotEmpty())
        <div class="flex mt-1 -space-x-2">
            @foreach ($group->recipients->take(3) as $recipient)
                <img
                    src="{{ $recipient->avatarUrl() }}"
                    alt="{{ $recipient->name }}"
                    class="rounded-full w-9 h-9 ring-2 ring-white hover:z-10"
                />
            @endforeach
            @if (($reaming = $group->recipients_count - 3) >= 1)
                <div
                    class="inline-flex items-center justify-center text-sm font-light text-gray-500 bg-gray-100 rounded-full ring-2 ring-white w-9 h-9">
                    <span> +{{ $reaming }}</span>
                </div>
            @endif
        </div>
    @endif
    <div
        x-data="{ isOpen: false }"
        class="absolute flex items-center top-4 right-4"
    >
        <div class="relative">
            <x-ui.button
                icon="ellipsis-vertical"
                size="sm"
                color="gray"
                @click.prevent="isOpen = !isOpen"
                x-ref="trigger"
                class="!ring-0 hover:bg-gray-100"
                x-bind:class="{ '!bg-gray-100': isOpen }"
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
                class="absolute z-10 mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 ring-1 ring-gray-200"
                role="menu"
                @click.away="isOpen = false"
            >
                <div class="p-2">
                    <span class="flex items-center gap-1.5">
                        <x-heroicon-s-bolt class="w-4 h-4 text-gray-500" />
                        <x-ui.text size="xs">Ações disponíveis</x-ui.heading>
                    </span>
                </div>
                @can('update group')
                    <div class="p-2">
                        <x-ui.button
                            :href="route('group.edit', $group)"
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
                @can('delete group')
                    <div class="p-2">
                        <livewire:group.delete
                            :group="$group"
                            wire:key="{{ $group->id }}"
                        />
                    </div>
                @endcan
            </div>
        </div>
    </div>

    <div class="absolute top-4 left-4">
        <x-ui.badge
            size="sm"
            :icon="$group->status->icon()"
            :color="$group->status->color()"
        >
            {{ $group->status->label() }}
        </x-ui.badge>
    </div>
</div>
