@props([
    'title' => 'Title',
    'icon' => null,
])

@php
    $id = md5($title ?? '');
@endphp

<div>
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <form
        id="{{ $id }}"
        wire:submit="handleOnSubmit"
    >
        {{ $this->form }}
    </form>

    <x-slot name="footer">
        <x-ui.button
            type="submit"
            :form-id="$id"
            full-size
            wire-target="handleOnSubmit"
        >Salvar</x-ui.button>
    </x-slot>
</div>
