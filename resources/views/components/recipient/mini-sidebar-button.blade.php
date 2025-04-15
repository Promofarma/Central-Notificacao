@props([
    'tabId' => null,
    'icon' => null,
    'label' => null,
])

<button
    {!! $attributes->merge([
        'class' => 'grid cursor-pointer place-items-center gap-y-1.5 focus:outline-none group',
    ]) !!}
    x-data="{
        isLoading: false,
    }"
    x-on:filter-updating.window="isLoading = true"
    x-on:filter-updated.window="setTimeout(() => isLoading = false, 1000)"
    x-bind:disabled="isLoading"
>
    @if ($icon)
        <div
            class="flex items-center justify-center w-10 h-10 rounded-full shrink-0"
            x-bind:class="tab === '{{ $tabId }}' ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-500'"
        >
            <template x-if="!isLoading">
                <x-dynamic-component
                    component="icon"
                    :name="$icon"
                    class="w-5 h-5 transition duration-200"
                />
            </template>
            <template x-if="isLoading">
                <x-ui.spinner />
            </template>
        </div>
    @endif
    @if ($label)
        <x-ui.text size="xs">
            {{ $label }}
        </x-ui.text>
    @endif
</button>
