@props([
    'icon' => null,
])
<div class="grid p-6 border-2 border-dashed rounded-lg col-span-full place-items-center gap-y-3 border-slate-200">
    @if ($icon)
        <x-dynamic-component
            component="icon"
            :name="'lucide-' . $icon"
            class="size-8 stroke-slate-500"
        />
    @endif

    @isset($title)
        <h3 class="text-lg font-bold text-slate-500">{{ $title }}</h3>
    @endisset

    @isset($description)
        <p class="text-sm text-slate-400">{{ $description }}</p>
    @endisset
</div>
