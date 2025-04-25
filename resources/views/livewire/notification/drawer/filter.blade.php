<x-ui.drawer icon="heroicon-s-funnel">
    <x-slot:title>
        Filtros
    </x-slot:title>

    {{ $this->form }}

    <x-slot:footer>
        <x-ui.button
            icon="trash"
            color="gray"
            full-size
            wire:click="handleResetFilter"
            wire-target="handleResetFilter"
        >Limpar Filtros</x-ui.button>

    </x-slot:footer>
</x-ui.drawer>
