@props([
    'tabId' => null,
    'iconName' => null,
    'label' => null,
])

<button
    {!! $attributes->merge([
        'class' =>
            'grid cursor-pointer place-items-center gap-y-2 focus:outline-none group [&>*]:transition [&>*]:duration-200',
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
            class="flex items-center justify-center rounded-lg w-9 h-9 group-hover:bg-primary-500 group-hover:text-white"
            x-bind:class="tab === '{{ $tabId }}' && 'bg-primary-500 text-white'"
        >
            <template x-if="!isLoading">
                <x-dynamic-component
                    component="icon"
                    :name="'lucide-' . $iconName"
                    class="w-6 h-6 transition duration-200 stroke-slate-400 group-hover:stroke-white"
                    x-bind:class="tab === '{{ $tabId }}' && 'stroke-white'"
                />
            </template>
            <template x-if="isLoading">
                <x-lucide-loader
                    class="w-6 h-6 stroke-slate-400 group-hover:stroke-white animate-spin"
                    x-bind:class="tab === '{{ $tabId }}' && 'stroke-white'"
                />
            </template>
        </div>
    @endif
    @if ($label)
        <span
            class="text-xs font-medium text-slate-500 group-hover:text-slate-900"
            x-bind:class="tab === '{{ $tabId }}' && 'text-slate-900'"
        >{{ $label }}</span>
    @endif
</button>
