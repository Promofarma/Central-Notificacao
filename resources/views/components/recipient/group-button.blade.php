@props([
    'label' => 'label',
    'count' => 0,
])
<button
    class="flex items-center justify-between p-3 transition-colors duration-150 border-b cursor-pointer text-slate-600 gap-x-3 hover:bg-white border-slate-200 focus:outline-none shrink-0"
    x-bind:class="isOpenGroupItem('{{ md5($label) }}') && 'bg-white text-slate-900'"
    role="button"
    title="Grupo: {{ $label }}"
    {!! $attributes !!}
>
    <div class="flex items-center gap-3">
        <span class="inline-flex items-center justify-center p-1 rounded-lg bg-slate-200">
            <x-lucide-chevron-down
                class="transition-transform duration-200 size-4 stroke-slate-400"
                x-bind:class="isOpenGroupItem('{{ md5($label) }}') ? 'rotate-0' : '-rotate-90'"
                wire:ignore.self
            />
        </span>
        <span class="flex-1 text-sm font-semibold truncate max-w-48">{{ $label }}</span>
    </div>
    <span class="text-xs font-bold text-slate-400">{{ $count > 99 ? '99+' : $count }}</span>
</button>
