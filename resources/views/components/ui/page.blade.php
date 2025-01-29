<div class="space-y-6">
    <header class="flex flex-col items-start gap-3 md:flex-row md:items-center md:justify-between">
        <h2 class="text-xl font-bold tracking-tight sm:text-2xl lg:text-3xl">
            {{ $title }}
        </h2>
        <div class="flex items-center gap-x-3">
            @foreach ($headerActions as $headerAction)
                {!! $headerAction !!}
            @endforeach
        </div>
    </header>
    @isset($subHeader)
        {!! $subHeader !!}
    @endisset
    {{ $slot }}
</div>
