@props([
'title' => null,
'headerButtons' => [],
])
<x-ui.page
    :$title
    :$headerButtons>
    <div class="p-4 overflow-auto">
        {{ $this->table }}
    </div>
</x-ui.page>