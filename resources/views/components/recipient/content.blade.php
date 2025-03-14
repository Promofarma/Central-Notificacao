@props([
    'categories' => [],
])
<section class="flex items-center justify-center py-6 mx-auto">
    <div class="w-full max-w-2xl px-4">
        <div class="grid grid-cols-2 gap-4">
            @foreach ($categories as $category)
                @php
                    $hasUnread = $category->notifications_unread_count > 0;
                @endphp
                <button
                    @click.prevent="$dispatch('open-group', '{{ md5($category->name) }}')"
                    class="flex items-center gap-3 p-4 bg-white border rounded-lg shadow-sm cursor-pointer focus:outline-none hover:border-slate-300 border-slate-200 shadow-slate-300/10"
                >
                    <div
                        class="inline-flex items-center justify-center rounded-full size-10 {{ $hasUnread ? 'bg-red-100' : 'bg-green-100' }}">
                        @if ($hasUnread)
                            <x-lucide-circle-alert class="size-5 stroke-red-600" />
                        @else
                            <x-lucide-check class="size-5 stroke-green-600" />
                        @endif
                    </div>
                    <div class="flex-1 space-y-1 text-start">
                        <h4 class="text-sm font-bold text-slate-700">{{ $category->name }}</h4>
                        <p class="text-xs text-slate-600">
                            {{ $hasUnread ? "Você tem {$category->notifications_unread_count} " . Str::plural('nova', $category->notifications_unread_count) . ' ' . Str::plural('notificação', $category->notifications_unread_count) : 'Tudo em dia!' }}
                        </p>
                    </div>
                </button>
            @endforeach
        </div>
    </div>
</section>
