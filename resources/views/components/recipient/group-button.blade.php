@props([
    'label' => 'label',
    'count' => 0,
])
<button
    class="flex items-center justify-between p-3 text-gray-600 transition-colors duration-150 border-b border-gray-200 cursor-pointer gap-x-3 hover:bg-white focus:outline-none shrink-0"
    x-bind:class="isOpenGroupItem('{{ md5($label) }}') && 'bg-white text-gray-900'"
    role="button"
    title="Grupo: {{ $label }}"
    {!! $attributes !!}
>
    <div class="flex items-center gap-1.5">
        <span class="inline-flex items-center justify-center p-1 bg-gray-100 rounded-lg">
            <x-heroicon-m-chevron-down
                class="text-gray-700 transition-transform duration-200 size-5"
                x-bind:class="isOpenGroupItem('{{ md5($label) }}') ? 'rotate-0' : '-rotate-180'"
                wire:ignore.self
            />
        </span>
        <div class="flex-1 truncate max-w-48">
            <x-ui.text size="sm">{{ $label }}</x-ui.text>
        </div>
    </div>
    <x-ui.badge size="sm">{{ $count > 99 ? '99+' : $count }}</x-ui.badge>
</button>
