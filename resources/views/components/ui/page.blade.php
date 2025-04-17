@props([
    'title' => 'title',
    'headerButtons' => [],
])
<section class="flex flex-col">
    <header class="flex items-center justify-between px-1 mb-8">
        <x-ui.heading size="xl">{{ $title }}</x-ui.heading>
        @isset($headerButtons)
            <div class="flex items-center gap-3">
                @foreach ($headerButtons as $button)
                    {!! $button !!}
                @endforeach
            </div>
        @endisset
    </header>
    {{ $slot }}
</section>
