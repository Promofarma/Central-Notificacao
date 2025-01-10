@props([
    'title' => null,
])
<div class="space-y-3">
    <h3 class="text-xs font-bold text-slate-600">{{ $title }}:</h3>
    {{ $slot }}
</div>
