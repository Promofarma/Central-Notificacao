@props([
    'files' => collect([]),
])
@if ($files->isNotEmpty())
    @foreach ($files as $attachment)
        <x-notification.attachment.item :attachment="$attachment" />
    @endforeach
@endif
