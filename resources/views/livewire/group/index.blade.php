<x-ui.page
    :$title
    :$headerButtons
>

    <div @class([
        'grid grid-cols-1 gap-4 md:grid-cols-3' => $this->userGroups->isNotEmpty(),
    ])>
        @forelse ($this->userGroups as $group)
            <x-group.item
                :group="$group"
                wire:key="{{ $group->id }}"
            />
        @empty
            <div class="col-span-1 md:col-span-1">
                <x-ui.empty-state>
                    <x-slot:icon>
                        <x-heroicon-s-exclamation-triangle />
                    </x-slot:icon>
                    <x-slot:title>
                        Nenhum grupo encontrado
                    </x-slot:title>
                    <x-slot:description>
                        Você ainda não criou nenhum grupo. Grupos ajudam a organizar os destinatários das suas
                        notificações de forma mais eficiente.
                    </x-slot:description>
                </x-ui.empty-state>
            </div>
        @endforelse
    </div>
</x-ui.page>
