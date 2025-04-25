<x-ui.drawer icon="heroicon-s-funnel">
    <x-slot:title>
        Filtros
    </x-slot:title>

    {{ $this->form }}

    <x-ui.button
        size="sm"
        icon="trash"
        color="gray"
        class="mt-4"
        wire:click="handleResetFilter"
        wire-target="handleResetFilter"
    >Limpar Filtros</x-ui.button>

</x-ui.drawer>
