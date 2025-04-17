    <x-ui.drawer>
        @if ($record)
            <x-base.drawer-form title="Editar Grupo: {{ $record->name }}" />
        @endif
    </x-ui.drawer>
