<x-ui.page
    :$title
    :$headerButtons
>
    <div>
        {{-- <livewire:notification.filter /> --}}

        <div @class([
            'grid grid-cols-1 gap-4 md:grid-cols-2' => $this->notifications->isNotEmpty(),
        ])>
            @forelse ($this->notifications as $notification)
                <x-notification.item
                    :$notification
                    wire:key="{{ $notification->uuid }}"
                />
            @empty
                <div class="col-span-1 md:col-span-1">
                    <x-ui.empty-state>
                        <x-slot:icon>
                            <x-heroicon-s-exclamation-triangle />
                        </x-slot:icon>
                        <x-slot:title>
                            Nenhuma notificação encontrada
                        </x-slot:title>
                        <x-slot:description>
                            Ainda não há nenhuma notificação cadastrada ou disponível para exibição.
                        </x-slot:description>
                    </x-ui.empty-state>
                </div>
            @endforelse
        </div>
    </div>
    <livewire:notification.modal.show />
    <livewire:notification.drawer.edit />
</x-ui.page>
