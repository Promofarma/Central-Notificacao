<div
    x-data="{
        isOpening: false,
    
        delay: 1000,
    
        selected: null,
    
        _notificationListItems: [],
    
        groupItems: @js($getGroupItems()),
    
        init() {
            this.cacheNotificationItems();
    
            this.$watch('isOpening', (value) => value ? this.disableButtons() : this.enableButtons());
        },
    
        toggleGroupItem(key) {
            if (!this.keyExists(key)) return;
    
    
            Object.keys(this.groupItems).forEach(k => {
                this.groupItems[k] = false;
            });
    
    
            if (!this.groupItems[key]) {
                this.groupItems[key] = true;
            }
        },
    
        isOpenGroupItem(key) {
            return this.groupItems[key];
        },
    
        closeGroupItem(key) {
            if (!this.keyExists(key)) return;
    
            if (!this.isOpenGroupItem(key)) return;
    
            this.groupItems[key] = false;
        },
    
        keyExists(key) {
            return key in this.groupItems;
        },
    
        cacheNotificationItems() {
            if (!this.$el) return;
    
            const notificationItems = this.$el.querySelectorAll('.n-item') ?? [];
            this._notificationListItems = Array.from(notificationItems);
        },
    
        get notificationListItems() {
            return this._notificationListItems;
        },
    
        enableButtons() {
            this.notificationListItems.forEach((item) => {
                item.classList.remove('pointer-events-none');
            });
        },
    
        disableButtons() {
            this.notificationListItems.forEach((item) => {
                item.classList.add('pointer-events-none');
            });
        },
    
        handleOnNotificationSelection(uuid) {
            if (!uuid || this.isOpening) return;
    
            this.isOpening = true;
    
            let timeout = null;
    
            try {
                this.selected = uuid;
    
                timeout = setTimeout(async () => {
                    try {
                        await $wire.set('selected', uuid);
                    } catch (err) {
                        console.error('Failed to set notification UUID:', err);
                    } finally {
                        this.isOpening = false;
                    }
                }, this.delay);
            } catch (err) {
                console.error('Error during notification selection:', err);
                this.isOpening = false;
                if (timeout) clearTimeout(timeout);
            }
        },
    
        handleOnResetedFilters() {
            this.selected = null;
    
            const reset = async () => {
                try {
                    await $wire.set('selected', null);
                } catch (err) {
                    console.error('Failed to reset filters:', err);
                }
            };
    
            reset();
        }
    }"
    class="flex flex-col flex-1 overflow-hidden bg-gray-50"
    x-on:filter-reseted.window="handleOnResetedFilters()"
    x-on:filter-updated.window="handleOnResetedFilters()"
    x-on:open-group.window="({ detail }) => toggleGroupItem(detail)"
>
    @forelse ($notificationRecipientItems as $groupName => $recipientNotifications)
        <div
            class="flex flex-col transition-all duration-300"
            x-bind:class="isOpenGroupItem('{{ md5($groupName) }}') ? 'flex-1 overflow-hidden' : 'h-auto'"
            {{-- x-on:click.outside="selected || closeGroupItem('{{ md5($groupName) }}')" --}}
            wire:key="{{ $getGroupItems()->keys()->join('-') }}"
        >
            <x-recipient.group-button
                :label="$groupName"
                :count="$recipientNotifications->count()"
                x-on:click.prevent="toggleGroupItem('{{ md5($groupName) }}')"
            />
            <div
                class="flex-1 h-0 overflow-y-auto max-h-[calc(100%-0.75rem*4)]"
                x-show="isOpenGroupItem('{{ md5($groupName) }}')"
                x-cloak
            >
                @foreach ($recipientNotifications as $recipientNotification)
                    <x-recipient.notification.item
                        :notification="$recipientNotification->notification"
                        :is-viewed="$recipientNotification->isViewed()"
                        :is-read="$recipientNotification->isRead()"
                        :is-archived="$recipientNotification->isArchived()"
                        wire:key="notification-{{ $recipientNotification->notification->uuid }}"
                    />
                @endforeach
            </div>
        </div>
    @empty
        <div class="flex items-center justify-center flex-1 p-3">
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
        </div>
    @endforelse

</div>
