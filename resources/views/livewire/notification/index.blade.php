<x-ui.page
    :$title
    :$headerActions
>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        @foreach ($this->notifications as $notification)
            <x-notification.item
                :$notification
                wire:key="{{ $notification->uuid }}"
            />
        @endforeach
    </div>
</x-ui.page>
