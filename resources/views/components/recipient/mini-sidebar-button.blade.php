@props([
    'tabId' => null,
    'iconName' => null,
    'label' => null,
])

<button
    {!! $attributes->merge([
        'class' => 'grid cursor-pointer place-items-center gap-y-2 focus:outline-none group',
    ]) !!}
    x-data="{
        isLoading: false,
    }"
    x-on:filter-updating.window="isLoading = true"
    x-on:filter-updated.window="setTimeout(() => isLoading = false, 1000)"
    x-bind:disabled="isLoading"
>
    @if ($iconName)
        <div
            class="flex items-center justify-center rounded-lg w-9 h-9 shrink-0"
            x-bind:class="tab === '{{ $tabId }}' ? 'bg-primary-500 text-white' : 'bg-slate-100 text-slate-400'"
        >
            <template x-if="!isLoading">
                <x-dynamic-component
                    component="icon"
                    :name="'lucide-' . $iconName"
                    class="w-5 h-5 transition duration-200"
                />
            </template>
            <template x-if="isLoading">
                <x-lucide-loader class="w-5 h-5 animate-spin" />
            </template>
        </div>
    @endif
    @if ($label)
        <span
            class="text-xs font-medium text-slate-500"
            x-bind:class="tab === '{{ $tabId }}' && 'text-slate-900'"
        >{{ $label }}</span>
    @endif
</button>
