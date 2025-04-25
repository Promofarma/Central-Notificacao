@props([
    'withControls' => false,
])
<div
    x-show="imagePath"
    class="fixed inset-0 bg-gray-900/50 z-[1]"
    x-cloak
></div>
<div
    x-show="imagePath"
    class="fixed inset-0 z-[99] flex items-center justify-center bg-black bg-opacity-50 select-none"
    x-cloak
>
    @if ($withControls)
        <button
            type="button"
            class="absolute z-20 flex items-center justify-center p-2 text-white transition -translate-y-1/2 rounded-full left-5 top-1/2 bg-white/50 hover:bg-white/60 backdrop-blur-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:outline-offset-0 dark:bg-surface-dark/40 dark:text-gray-600-dark dark:hover:bg-surface-dark/60 dark:focus-visible:outline-primary-dark"
            aria-label="Voltar para imagem anterior"
            @click.prevent="previous()"
            @keydown.left.window="previous()"
            x-show="slides.length > 1"
        >
            <x-heroicon-s-chevron-left class="size-5 md:size-6 pr-0.5" />
        </button>

        <button
            type="button"
            class="absolute z-20 flex items-center justify-center p-2 text-white transition -translate-y-1/2 rounded-full right-5 top-1/2 bg-white/50 hover:bg-white/60 backdrop-blur-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:outline-offset-0 dark:bg-surface-dark/40 dark:text-gray-600-dark dark:hover:bg-surface-dark/60 dark:focus-visible:outline-primary-dark"
            aria-label="Ir para próxima imagem"
            @click.prevent="next()"
            @keydown.right.window="next()"
            x-show="slides.length > 1"
        >
            <x-heroicon-s-chevron-right class="size-5 md:size-6 pl-0.5" />
        </button>
    @endif
    <div
        class="relative flex flex-col items-center justify-center"
        x-show="imagePath"
        x-cloak
    >
        <img
            x-bind:src="{{ $withControls ? 'slides[currentSlideIndex - 1].imgSrc' : 'imagePath' }}"
            alt="Imagem do Anexo"
            class="block object-contain object-center max-w-[600px] max-h-[600px] w-full h-full select-none cursor-zoom-out"
            draggable="false"
            width="600"
            height="600"
            @click="imagePath = null"
            @keydown.escape.window="imagePath = null"
        />

        <div class="absolute bottom-2  p-2 flex items-center gap-x-1.5 mt-4 rounded-full bg-black/50 backdrop-blur">
            <x-heroicon-m-exclamation-circle class="w-4 h-4 text-white shrink-0" />
            <x-ui.text
                size="xs"
                class="text-white"
            >Clique na imagem ou pressione "ESC" para fechar</x-ui.text>
        </div>
    </div>

</div>
