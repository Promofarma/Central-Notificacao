@props([
    'recipient' => null,
])
<div
    @class([
        'relative inline-flex items-center ring-1 select-none text-sm font-bold shadow-sm shadow-slate-300/10 ring-slate-200 justify-center bg-white rounded-lg size-9',
        'opacity-50' => !$recipient->isRead(),
    ])
    {!! $recipient->isRead()
        ? 'x-data x-tooltip="\'Visto em ' . $recipient->read_at . ' - IP: ' . $recipient->ip_address . '\'"'
        : '' !!}
>
    P{{ $recipient->recipient->id }}

    <span class="absolute -bottom-1 -right-1 size-4">
        <div @class([
            'size-full inline-flex items-center text-white justify-center rounded-full',
            'bg-green-500' => $recipient->isRead(),
            'bg-red-500' => !$recipient->isRead(),
        ])>
            <x-dynamic-component
                component="icon"
                :name="$recipient->isRead() ? 'lucide-check' : 'lucide-x'"
                class="stroke-current size-3"
            />
        </div>
    </span>
</div>
