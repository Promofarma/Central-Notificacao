@props([
'title' => 'title',
'headerButtons' => [],
])
<section
    class="
        flex
        flex-col
        [&>*:not(header)]:flex-1
        [&>*:not(header)]:h-px
        [&>*:not(header)]:overflow-y-auto
        [&>*:not(header)]:overflow-x-auto
        [&>*:not(header)::-webkit-scrollbar]:w-1
        [&>*:not(header)::-webkit-scrollbar-track]:bg-secondary
        [&>*:not(header)::-webkit-scrollbar-thumb]:bg-primary
    ">
    <header @class(['flex items-center px-4 h-14 shrink-0' , 'justify-between'=> filled($headerButtons),
        ])>
        <h2 class="text-lg font-bold">
            {{ $title }}
        </h2>
        @if (filled($headerButtons))
        <div class="flex items-center gap-2">
            @foreach ($headerButtons as $button)
            {!! $button !!}
            @endforeach
        </div>
        @endif

    </header>
    @isset($subHeader)
    {{ $subHeader }}
    @endisset
    {{ $slot }}
</section>