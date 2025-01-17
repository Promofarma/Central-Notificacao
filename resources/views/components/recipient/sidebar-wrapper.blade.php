@props([
    'title' => null,
    'icon' => null,
])
<div {!! $attributes->merge(['class' => 'flex flex-col flex-1 bg-slate-50']) !!}>
    <div
        class="flex items-center h-full gap-3 px-4 py-3 border-b shadow-md max-h-14 shrink-0 border-slate-200 shadow-slate-300/10">
        @if ($icon)
            <x-dynamic-component
                name="icon"
                component="lucide-{{ $icon }}"
                class="size-5 stroke-slate-500"
            />
        @endif
        <h3 class="text-lg font-bold">{{ $title }}</h3>
    </div>
    {{ $slot }}
</div>
