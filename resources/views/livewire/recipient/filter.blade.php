<x-filter.wrapper>
    <div class="p-3 space-y-6">
        {{ $this->form }}

        <x-ui.button
            size="sm"
            icon="trash"
            wire:click="handleFilterReset"
            wire-target="handleFilterReset"
            x-bind:disabled="!isFilled()"
        >
            Limpar Filtros
        </x-ui.button>
    </div>
</x-filter.wrapper>
