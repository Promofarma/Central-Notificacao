<x-filter.wrapper :$activeFilters>
    <x-slot:target>
        <div class="flex justify-end pr-0.5">
            <x-ui.button
                icon="filter"
                x-ref="target"
                x-bind:class="{
                    'ring ring-primary-200': isOpen,
                }"
            >
                Filtros
            </x-ui.button>
        </div>
    </x-slot:target>
    <div
        class="absolute z-10 mt-3 bg-white border rounded-md shadow w-80 border-slate-200 shadow-black/5"
        x-show="isOpen"
        x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-out duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-anchor.bottom-start="$refs.target"
        x-cloak
        @click.outside="isOpen = false"
    >
        <div class="flex items-center justify-between p-4">
            <h4 class="text-base font-semibold text-slate-600">Filtros</h4>
            <x-ui.button
                size="small"
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
</x-filter.wrapper>
