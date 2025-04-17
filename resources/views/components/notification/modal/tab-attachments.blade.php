@props([
    'attachments' => [],
])
<div class="space-y-4">
    @foreach ($attachments as $attachment)
        <x-notification.attachment.item
            direction="column"
            :attachment="$attachment"
        />
    @endforeach
</div>
