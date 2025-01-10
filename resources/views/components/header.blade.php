@php
    $user = Auth::user();
@endphp
<!-- Header -->
<header
    class="flex items-center justify-between gap-3 px-6 bg-white border-b shadow-sm h-14 border-slate-200 shadow-slate-300/10"
    aria-label="Main Header"
>
    <div class="flex items-center gap-3 md:ps-6 shrink-0">
        <div
            class="flex items-center justify-center w-8 h-8 rounded-lg text-primary-600 bg-primary-100 ring-1 ring-primary-200"
            aria-hidden="true"
        >
            <x-lucide-box class="w-5 h-5" />
        </div>
        <h1 class="hidden text-base font-semibold text-slate-900 md:block">
            {{ config('app.name') }}
        </h1>
    </div>
    <div class="flex items-center gap-3">
        <span class="text-sm font-medium text-slate-600">
            Olá, <span class="font-semibold text-slate-900">{{ $user->name }}</span>
        </span>
        <div
            class="flex items-center justify-center w-8 h-8 font-bold text-white rounded-lg bg-slate-900"
            aria-label="User Icon"
        >
            {{ $user->name[0] }}
        </div>
    </div>
</header>
<!-- Header -->
