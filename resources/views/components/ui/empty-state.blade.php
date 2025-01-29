<div class="flex flex-col items-center justify-center p-6 border border-dashed rounded-lg gap-y-3 border-slate-200">
    @isset($icon)
        <div
            class="flex items-center justify-center shrink-0 p-2 rounded-lg bg-slate-200 text-slate-400 [&>svg]:size-6 [&>svg]:stroke-slate-400">
            {{ $icon }}
        </div>
    @endisset
    @isset($title)
        <h4 class="text-sm font-semibold text-slate-600">
            {{ $title }}
        </h4>
    @endisset
    @isset($description)
        <p class="text-xs text-slate-500">
            {{ $description }}
        </p>
    @endisset
</div>
