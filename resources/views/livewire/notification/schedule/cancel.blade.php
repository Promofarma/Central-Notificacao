<x-ui.button
    size="small"
    icon="x"
    wire:confirm="Voce realmente deseja cancelar o agendamento?"
    wire:click="cancel"
    wire-target="cancel"
>
    Cancelar
</x-ui.button>
