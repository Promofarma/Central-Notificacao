<div
    x-data="{
        imagePath: null,
    
    }"
    {!! $attributes->class([
            'flex-col' => $direction === 'column',
        ])->merge([
            'class' => 'flex items-center gap-3 p-3 bg-white rounded-lg shadow-sm ring-1 ring-gray-950/10',
        ]) !!}
>
    <div class="flex items-center justify-center overflow-hidden bg-gray-100 rounded-lg size-10 shrink-0">
        @if ($attachment->isImage())
            <img
                src="{{ $attachment->path }}"
                alt="{{ $attachment->file_name }}"
                class="object-cover w-full h-full cursor-zoom-in"
                draggable="false"
                @click="imagePath = '{{ $attachment->path }}'"
            />
        @else
            <x-heroicon-s-document class="w-6 h-6 stroke-gray-600 shrink-0" />
        @endif
    </div>

    <div class="grid flex-1 gap-2">
        <x-ui.heading>{{ $attachment->file_name }}</x-ui.heading>
        <ul @class([
            'justify-center' => $direction === 'column',
            'flex items-center text-xs text-gray-500 gap-x-4',
        ])>
            <li>
                <x-ui.text
                    size="xs"
                    variant="subtle"
                >Tamanho: {{ $attachment->size }}</x-ui.text>
            </li>
            <li>
                <x-ui.text
                    size="xs"
                    variant="subtle"
                >Extensão: {{ $attachment->extension }}</x-ui.text>
            </li>
        </ul>
    </div>

    <div class="flex gap-3 shrink-0">
        @if ($attachment->isImage())
            <x-ui.button
                size="sm"
                icon="eye"
                color="gray"
                @click="imagePath = '{{ $attachment->path }}'"
            />
        @endif
        <x-ui.button
            size="sm"
            icon="arrow-down-tray"
            color="gray"
            @click="window.open('{{ $attachment->path }}', '_blank');"
        />
    </div>

    @if ($attachment->isImage())
        <x-notification.attachment.image-preview />
    @endif
</div>
