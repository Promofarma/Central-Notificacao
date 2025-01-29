@props([
    'for' => null,
])
<label
    class="absolute inset-0"
    for="{{ $for }}"
><span class="sr-only">Focus on the big picture</span></label>
<article class="p-6 bg-white border rounded-lg shadow-sm border-slate-200">
    <header class="mb-2">
        <div class="inline-flex items-center justify-center bg-slate-50 size-11">
            <x-lucide-check class="size-6" />
        </div>

        @isset($title)
            <h1 class="text-xl font-bold text-slate-900">{{ $title }}</h1>
        @endisset
    </header>
    <div class="mb-2 space-y-4 text-sm leading-relaxed text-slate-500">
        @isset($description)
            {!! $description !!}
        @endisset
    </div>
</article>
