<div x-data="{
    filterData: $wire.entangle('filterData'),

    isOpen: false,

    isFilled() {
        return this.checkPropertiesIsFilled(this.filterData);
    },

    checkPropertiesIsFilled(obj) {
        return Object.values(obj).some((value) => {
            if (Array.isArray(value)) {
                return value.length > 0;
            }

            if (typeof value === 'object' && value !== null) {
                return this.checkPropertiesIsFilled(value);
            }

            return value !== null && value !== '';
        });
    }
}">
    <div
        class="absolute z-10 mt-3 bg-white rounded-md shadow ring-1 w-80 ring-gray-200 shadow-black/5"
        x-show="isOpen"
        x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-out duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-cloak
        x-anchor.bottom-end.offset.4="document.getElementById('trigger')"
        x-on:open-filter.window="isOpen = !isOpen"
        @click.outside="isOpen = false"
    >
        <div class="flex items-center justify-between p-4">
            <x-ui.heading level="4">Filtros</x-ui.heading>
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
        <div class="p-4 space-y-6">
            {{ $this->form }}
        </div>
    </div>
</div>
