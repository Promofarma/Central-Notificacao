@use('\App\Enums\ScheduleResultStatus')
<div class="space-y-4">
    @foreach ($schedule->results as $result)
        <div class="relative">
            <div class="absolute top-4 bottom-0 left-[36px] z-0 w-px bg-gray-300 border-l"></div>
            <div class="relative flex items-start">
                <x-ui.text
                    size="sm"
                    class="w-20 mr-2 text-center shrink-0 bg-gray-50"
                >
                    {{ $result->display_scheduled_date }}
                </x-ui.text>
                <div class="flex-1">
                    <div class="p-2 space-y-2 text-center bg-white rounded-lg shadow-sm ring-1 ring-gray-950/10">
                        <span class="inline-flex items-center gap-1.5">
                            <x-heroicon-m-bell-alert class="w-4 h-4 text-gray-500 shrink-0" />
                            <x-ui.text size="sm">Daqui à {{ $result->deadline() }}
                                {{ Str::plural('Dia', $result->deadline()) }}
                            </x-ui.text>
                        </span>
                        <div class="flex items-center gap-x-2">
                            <x-ui.badge
                                :icon="$result->status->icon()"
                                :color="$result->status->color()"
                                full-size
                            >{{ $result->status->label() }}</x-ui.badge>
                            @if ($result->status === ScheduleResultStatus::Pending && $result->deadline() > 0)
                                <livewire:notification.schedule.cancel
                                    :result="$result"
                                    wire:key="cancel-{{ $result->id }}"
                                />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>
