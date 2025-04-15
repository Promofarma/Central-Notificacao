@props([
    'title' => null,
    'headerButtons' => [],
])
<x-ui.page
    :$title
    :$headerButtons
>
    <div>
        {{ $this->table }}
    </div>
</x-ui.page>
