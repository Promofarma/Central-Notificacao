<div
    x-data="{
        isOpening: false,

        delay: 1000,

        selected: null,

        _notificationListItems: [],

        groupItems: $persist(@js($getGroupItems())).as('group-items'),

        init() {
            this.cacheNotificationItems();

            this.$watch('isOpening', (value) => value ? this.disableButtons() : this.enableButtons());
        },

        toggleGroupItem(key) {
            if (!this.keyExists(key)) return;

            this.groupItems[key] = !this.groupItems[key];
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
    class="flex flex-col flex-1 overflow-hidden"
    x-on:filter-reseted.window="handleOnResetedFilters()"
    x-on:filter-updated.window="handleOnResetedFilters()"
>
    @forelse ($groupedRecipientNotifications as $groupName => $recipientNotifications)
        <div
            class="flex flex-col"
            x-bind:class="isOpenGroupItem('{{ md5($groupName) }}') && 'flex-1 overflow-hidden'"
            x-on:click.outside="selected || closeGroupItem('{{ md5($groupName) }}')"
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
                        :is-read="$recipientNotification->isRead()"
                        :is-archived="$recipientNotification->isArchived()"
                        wire:key="notification-{{ $recipientNotification->notification->uuid }}"
                    />
                @endforeach
            </div>
        </div>
    @empty
        <div class="p-3 grid h-full place-content-center opacity-75">
            <x-ui.empty-state icon="inbox">
                <x-slot:description>
                    Sem notificações no momento.
                </x-slot:description>
            </x-ui.empty-state>
        </div>
    @endforelse

</div>
