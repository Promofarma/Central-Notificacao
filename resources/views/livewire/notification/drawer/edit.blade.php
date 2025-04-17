<x-ui.drawer icon="heroicon-s-pencil">
    @if ($record)
        <x-base.drawer-form title="Editar Notificação: {{ $record->title }}" />
    @endif
</x-ui.drawer>
