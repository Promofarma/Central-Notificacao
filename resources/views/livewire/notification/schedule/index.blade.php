@use('App\Enums\ScheduleResultStatus')
<div class="overflow-auto rounded-lg shadow-sm ring-1 ring-slate-200 shadow-slate-300/10">
    <table class="w-full">
        <thead class="border-b bg-slate-50 border-slate-200">
            <tr>
                <th
                    class="px-3 py-1.5 text-xs text-ellipsis uppercase text-slate-500 text-left"
                    scope="col"
                >Data</th>
                <th
                    class="px-3 py-1.5 text-xs text-ellipsis uppercase text-slate-500 text-left"
                    scope="col"
                >Status</th>
                <th
                    class="px-3 py-1.5 text-xs text-ellipsis uppercase text-slate-500 text-right"
                    scope="col"
                >Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $result)
                <tr class="border-b border-slate-200 last:border-0 odd:bg-white">
                    <td
                        class="px-3 py-1.5 text-xs text-ellipsis font-bold text-left"
                        scope="row"
                    >
                        {{ $result->display_scheduled_date }}
                        {{ $result->display_scheduled_time }}
                        @if ($result->deadline() > 0)
                            <span class="font-medium text-slate-400">(Daqui à {{ $result->deadline() }}
                                {{ Str::plural('dia', $result->deadline()) }})</span>
                        @endif
                    </td>
                    <td class="px-3 py-1.5 text-xs text-ellipsis">
                        <x-ui.badge
                            :icon="ScheduleResultStatus::icon($result->status)"
                            :color="ScheduleResultStatus::color($result->status)"
                        >
                            {{ __(ucfirst($result->status->value)) }}
                        </x-ui.badge>
                    </td>
                    <td class="px-3 py-1.5 text-xs text-ellipsis">
                        <div class="flex justify-end">
                            @if ($result->status === ScheduleResultStatus::Pending && today()->lt($result->scheduled_date))
                                <livewire:notification.schedule.cancel
                                    :$result
                                    wire:key="{{ $result->id }}"
                                />
                            @endif

                            @if ($result->status === ScheduleResultStatus::Created)
                                <span class="font-medium text-slate-400">
                                    Criado em {{ $result->created_at->format('d/m/Y à\\s H:i') }}
                                </span>
                            @endif

                            @if ($result->status === ScheduleResultStatus::Cancelled)
                                <span class="font-medium text-slate-400">
                                    Cancelado em {{ $result->canceled_at->format('d/m/Y à\\s H:i') }}
                                </span>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
