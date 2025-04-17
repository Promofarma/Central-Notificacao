<div class="flex flex-col items-center justify-center p-6 text-center opacity-90 gap-y-3">
    @isset($icon)
        <div class="flex items-center justify-center w-12 h-12 p-2 bg-gray-100 rounded-full text-gray-700 [&>svg]:size-6">
            {{ $icon }}
        </div>
    @endisset

    @isset($title)
        <x-ui.heading
            level="4"
            size="base"
        >
            {{ $title }}
        </x-ui.heading>
    @endisset

    @isset($description)
        <x-ui.text
            size="xs"
            variant="subtle"
        >
            {{ $description }}
        </x-ui.text>
    @endisset
</div>
