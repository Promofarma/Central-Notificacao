@props([
    'files' => collect([]),
])
@if ($files->isNotEmpty())
    <div class="p-4">
        <x-ui.container
            title="Anexos"
            class="space-y-2"
        >
            @foreach ($files as $attachment)
                <x-notification.attachment.item :attachment="$attachment" />
            @endforeach
        </x-ui.container>
    </div>
@endif
