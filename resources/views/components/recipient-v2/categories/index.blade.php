@props(['categories'])
<div class="flex flex-col bg-white max-w-64 grow">
    <div class="flex items-center px-4 border-b shrink-0 gap-x-2 h-14 border-gray-950/10">
        <x-ui.heading level="4">Categorias</x-ui.heading>
    </div>

    <nav
        x-data
        class="relative flex flex-col flex-1 h-px px-2 py-4 overflow-y-auto gap-y-2"
    >
        @forelse ($categories as $category)
            <x-recipient-v2.categories.item
                :category="$category"
                wire:click="category === {{ $category->id }} ? false : $wire.set('category', {{ $category->id }})"
                wire:loading.attr="data-loading"
                wire:target="category"
                wire:key="category-{{ $category->id }}"
                x-bind:class="{
                    'bg-primary-400/20 text-primary-700': $wire.category === {{ $category->id }},
                }"
            />
        @empty
            <x-ui.empty-state>
                <x-slot:icon>
                    <x-heroicon-s-exclamation-triangle />
                </x-slot:icon>
                <x-slot:title>
                    Ops! Não encontramos nenhuma categoria
                </x-slot:title>
            </x-ui.empty-state>
        @endforelse

        @if (filled($categories))
            <x-recipient-v2.tab.loading-overlay target="tab">
                Carregando categorias, por favor, aguarde...
            </x-recipient-v2.tab.loading-overlay>
        @endif
    </nav>
</div>
