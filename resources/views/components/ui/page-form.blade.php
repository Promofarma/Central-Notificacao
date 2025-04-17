@props([
    'title' => null,
    'headerButtons' => [],
    'formId' => null,
])
<x-ui.page
    :$title
    :$headerButtons
>
    <div>
        <form
            id="{{ $formId }}"
            wire:submit="handleOnSubmit"
            novalidate
        >
            {{ $this->form }}
        </form>
    </div>
</x-ui.page>
