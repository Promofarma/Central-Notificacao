<x-ui.modal>
    @if (filled($notification))
        <div class="flex h-full divide-x divide-950/10">
            <div class="flex flex-col flex-1">
                <div class="p-4 border-b shrink-0 h-14 border-gray-950/10">
                    <x-ui.heading
                        size="lg"
                        level="3"
                    >{{ $notification->title }}</x-ui.heading>
                </div>
                <div class="flex-1 h-px p-4 overflow-y-auto">
                    <div class="prose prose-gray max-w-none">
                        {!! $notification->content !!}
                    </div>
                </div>
            </div>

            <div
                x-data="{ tab: 'recipients' }"
                x-init="$watch('isOpen', () => tab = 'recipients')"
                class="flex flex-col rounded-r-lg w-80 shrink-0 bg-gray-50"
            >
                <div class="relative flex items-center p-4 border-b gap-x-4 h-14 border-gray-950/10 shrink-0">
                    <div class="flex-1 space-x-2">
                        <button
                            class="inline-flex items-center justify-center w-8 h-8 text-gray-600 transition duration-75 rounded-full hover:bg-white hover:ring-gray-300 ring-1 ring-gray-200 shrink-0 focus:outline-none hover:text-gray-950"
                            x-bind:class="tab === 'recipients' ? 'shadow-sm bg-white ring-gray-300 text-gray-950 opacity-100' :
                                'opacity-50'"
                            @click="tab = 'recipients'"
                        >
                            <x-heroicon-s-eye class="w-5 h-5 shrink-0" />
                        </button>
                        <button
                            class="inline-flex items-center justify-center w-8 h-8 text-gray-600 transition duration-75 rounded-full hover:bg-white hover:ring-gray-300 ring-1 ring-gray-200 shrink-0 focus:outline-none hover:text-gray-950"
                            x-bind:class="tab === 'attachments' ? 'shadow-sm bg-white ring-gray-300 text-gray-950 opacity-100' :
                                'opacity-50'"
                            @click="tab = 'attachments'"
                        >
                            <x-heroicon-s-paper-clip class="w-5 h-5 shrink-0" />
                        </button>
                        @if ($notification->schedule)
                            <button
                                class="inline-flex items-center justify-center w-8 h-8 text-gray-600 transition duration-75 rounded-full hover:bg-white hover:ring-gray-300 ring-1 ring-gray-200 shrink-0 focus:outline-none hover:text-gray-950"
                                x-bind:class="tab === 'schedules' ? 'shadow-sm bg-white ring-gray-300 text-gray-950 opacity-100' :
                                    'opacity-50'"
                                @click="tab = 'schedules'"
                            >
                                <x-heroicon-s-calendar-days class="w-5 h-5 shrink-0" />
                            </button>
                        @endif
                    </div>
                    <x-ui.button
                        icon="x-mark"
                        size="sm"
                        color="gray"
                        class="shrink-0"
                        @click="isOpen = false"
                    />
                </div>

                <div class="flex-1 h-px p-4 overflow-y-auto">
                    <div x-show="tab === 'recipients'">
                        <x-notification.modal.tab-recipients :notification="$notification" />
                    </div>

                    <div x-show="tab === 'attachments'">
                        <x-notification.modal.tab-attachments :attachments="$notification->attachments" />
                    </div>

                    @if ($notification->schedule)
                        <div x-show="tab === 'schedules'">
                            <livewire:notification.schedule.index
                                :schedule="$notification->schedule"
                                wire:key="schedule-{{ $notification->uuid }}"
                            />
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</x-ui.modal>
