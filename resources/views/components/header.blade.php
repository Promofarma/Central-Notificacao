@php
    $user = Auth::user();
@endphp
<header
    class="flex items-center justify-between gap-3 px-4 bg-white border-b border-gray-200 shadow-sm h-14 shadow-gray-300/10"
    aria-label="Main Header"
>
    <div class="flex items-center gap-3 md:ps-3 shrink-0">
        <div
            class="flex items-center justify-center w-8 h-8 rounded-lg text-primary-600 bg-primary-100 ring-1 ring-primary-200"
            aria-hidden="true"
        >
            <x-lucide-box class="w-5 h-5" />
        </div>
        <h1 class="hidden text-base font-semibold text-gray-900 md:block">
            {{ config('app.name') }}
        </h1>
    </div>
    <div class="flex items-center gap-3">
        <span class="text-sm font-medium text-gray-600">
            Olá, <span class="font-semibold text-gray-900">{{ $user->name }}</span>
        </span>
        <div
            class="flex items-center justify-center w-8 h-8 font-bold text-white bg-gray-900 rounded-lg"
            aria-label="User Icon"
        >
            {{ $user->name[0] }}
        </div>
    </div>
</header>
