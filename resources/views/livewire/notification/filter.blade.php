<x-filter.wrapper :$activeFilters>
    <x-slot:target>
        <x-ui.button
            icon="filter"
            x-ref="target"
            x-bind:class="{
                'ring ring-primary-200': isOpen,
            }"
        >
            Filtros
        </x-ui.button>
    </x-slot:target>
    <div
        class="absolute z-10 mt-4 bg-white divide-y rounded-lg shadow-lg divide-slate-200 w-80 ring-1 ring-slate-300/60 shadow-slate-300/60"
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
        <div class="flex items-center justify-between px-5 py-4">
            <div class="flex items-center gap-3">
                <x-lucide-filter class="size-4" />
                <h4 class="text-sm font-semibold text-slate-700">Filtros</h4>
            </div>
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
        <div class="px-5 py-6 space-y-6">
            {{ $this->form }}
        </div>
    </div>
</x-filter.wrapper>
