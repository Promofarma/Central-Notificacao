<x-ui.page
    :$title
    :$headerActions
    :$formId
>
    <form
        id="{{ $formId }}"
        wire:submit="create"
        novalidate
    >
        {{ $this->form }}
    </form>
</x-ui.page>
