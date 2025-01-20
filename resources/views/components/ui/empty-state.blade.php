@props([
    'icon' => null,
])
<div
    class="grid p-6 border-2 border-dashed rounded-lg select-none opacity-80 col-span-full place-items-center gap-y-3 border-slate-300">
    @if ($icon)
        <x-dynamic-component
            component="icon"
            :name="'lucide-' . $icon"
            class="size-6 stroke-slate-500"
        />
    @endif

    @isset($title)
        <h3 class="text-sm font-bold text-slate-500">{{ $title }}</h3>
    @endisset

    @isset($description)
        <p class="text-xs text-slate-500">{{ $description }}</p>
    @endisset
</div>
