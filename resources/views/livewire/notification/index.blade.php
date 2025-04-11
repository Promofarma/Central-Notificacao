<x-ui.page
    :$title
    :$headerButtons>
    <x-slot:sub-header>
        <livewire:notification.filter />
    </x-slot:sub-header>
    <div class="grid grid-cols-1 gap-6">
        @forelse ($this->notifications as $notification)
        <x-notification.item
            :$notification
            wire:key="{{ $notification->uuid }}" />
        @empty
        <x-ui.empty-state>
            <x-slot:icon>
                <x-lucide-x />
            </x-slot:icon>
            <x-slot:title>
                Nenhuma notificação encontrada
            </x-slot:title>
            <x-slot:description>
                Não encontramos nenhuma registro.
            </x-slot:description>
        </x-ui.empty-state>
        @endforelse
    </div>


</x-ui.page>