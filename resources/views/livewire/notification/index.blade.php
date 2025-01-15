<x-ui.page
    :$title
    :$headerActions
>
    <x-slot:sub-header>
        <livewire:notification.filter />
    </x-slot:sub-header>


    <div class="grid grid-cols-1 gap-y-6">
        @foreach ($this->notifications as $notification)
            <x-notification.item
                :$notification
                wire:key="{{ $notification->uuid }}"
            />
        @endforeach
    </div>


</x-ui.page>
