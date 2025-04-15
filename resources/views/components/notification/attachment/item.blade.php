<div
    x-data="{
        imagePath: null,
    
    }"
    class="flex items-center gap-3 p-3 bg-white rounded-lg shadow-sm ring-1 ring-gray-200/50 shadow-gray-300/10"
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
            <x-heroicon-s-document class="size-6 stroke-gray-600" />
        @endif
    </div>

    <div class="grid flex-1 gap-2">
        <h3 class="text-sm font-medium text-gray-700">{{ $attachment->file_name }}</h3>
        <ul class="flex items-center text-xs text-gray-500 gap-x-4">
            <li>Tamanho: <strong>{{ $attachment->size }}</strong></li>
            <li>Extensão: <strong>{{ $attachment->extension }}</strong></li>
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
