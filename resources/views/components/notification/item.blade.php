<a
    href="{{ route('notification.show', $notification) }}"
    {!! $attributes->merge([
        'class' =>
            'block bg-white divide-y ring-1 ring-slate-200/75 transition duration-200 ease-in hover:ring-slate-300 divide-slate-100 overflow-hidden rounded-md shadow-sm focus-visible:outline-none',
    ]) !!}
>
    <div class="p-4 space-y-4">
        <div class="flex items-center gap-3">
            <x-lucide-bell class="w-5 h-5 stroke-slate-400" />
            <h3 class="flex-1 text-lg font-bold text-slate-700">{{ $notification->title }}</h3>
        </div>
        <div class="flex items-center justify-between text-slate-600">
            <span class="px-3 py-1 text-xs font-medium rounded-md bg-slate-100">
                Criado em:
            </span>
            <div
                class="flex items-center gap-4"
                x-data
            >
                <div
                    class="flex items-center gap-2"
                    x-tooltip="'Total de destinatários'"
                >
                    <x-lucide-users class="w-4 h-4 stroke-slate-600" />
                    <span class="text-sm font-medium">{{ $notification->recipients_count }}</span>
                </div>

                <div
                    class="flex items-center gap-2"
                    x-tooltip="'Total de anexos'"
                >
                    <x-lucide-files class="w-4 h-4 stroke-slate-600" />
                    <span class="text-sm font-medium">{{ $notification->attachments_count }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="p-4 bg-slate-50">
        <dd class="flex items-center gap-3">
            <div class="relative flex-1 h-3 overflow-hidden rounded-full bg-slate-200">
                <span
                    style="width: {{ $getPercentageRead() }};"
                    class="absolute h-full duration-300 ease-linear bg-green-500 animate-pulse"
                ></span>
            </div>
            <span class="text-xs font-medium text-slate-500 shrink-0">
                {{ $getPercentageRead() }} lidas
            </span>
        </dd>
    </div>
</a>
