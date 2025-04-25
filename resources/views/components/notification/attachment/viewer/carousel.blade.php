@props([
    'images' => collect([]),
])
@if ($images->isNotEmpty())
    <div
        x-data="{
            imagePath: null,
        
            slides: @js($images),
        
            currentSlideIndex: 1,
        
            previous() {
                if (this.currentSlideIndex > 1) {
                    this.currentSlideIndex = this.currentSlideIndex - 1
                } else {
                    this.currentSlideIndex = this.slides.length
                }
            },
        
            next() {
                if (this.currentSlideIndex < this.slides.length) {
                    this.currentSlideIndex = this.currentSlideIndex + 1
                } else {
                    this.currentSlideIndex = 1
                }
            },
        }"
        class="relative w-full overflow-hidden"
    >
        <button
            type="button"
            class="absolute z-20 flex items-center justify-center p-2 text-gray-600 transition -translate-y-1/2 rounded-full left-5 top-1/2 bg-gray-950/5 hover:bg-gray-950/10 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:outline-offset-0 dark:bg-surface-dark/40 dark:text-gray-600-dark dark:hover:bg-surface-dark/60 dark:focus-visible:outline-primary-dark"
            aria-label="Voltar para imagem anterior"
            x-on:click="previous()"
            x-show="slides.length > 1"
        >
            <x-heroicon-s-chevron-left class="size-5 md:size-6 pr-0.5" />
        </button>

        <button
            type="button"
            class="absolute z-20 flex items-center justify-center p-2 text-gray-600 transition -translate-y-1/2 rounded-full right-5 top-1/2 bg-gray-950/5 hover:bg-gray-950/10 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:outline-offset-0 dark:bg-surface-dark/40 dark:text-gray-600-dark dark:hover:bg-surface-dark/60 dark:focus-visible:outline-primary-dark"
            aria-label="Ir para próxima imagem"
            x-on:click="next()"
            x-show="slides.length > 1"
        >
            <x-heroicon-s-chevron-right class="size-5 md:size-6 pl-0.5" />
        </button>
        <div class="relative bg-white border border-gray-950/10 shadow-sm rounded-lg min-h-[50svh] w-full">
            <template x-for="(slide, index) in slides">
                <div
                    x-show="currentSlideIndex == index + 1"
                    class="absolute inset-0"
                    x-transition.opacity.duration.1000ms
                >
                    <img
                        class="absolute inset-0 object-contain w-full h-full cursor-zoom-in"
                        x-bind:src="slide.imgSrc"
                        x-bind:alt="slide.imgAlt"
                        @click="imagePath = slide.imgSrc"
                    />
                </div>
            </template>
        </div>
        <div
            class="absolute bottom-3 md:bottom-5 left-1/2 z-20 flex -translate-x-1/2 gap-4 md:gap-3 bg-gray-950/10 rounded-lg px-1.5 py-1 md:px-2"
            role="group"
            aria-label="images"
        >
            <template x-for="(slide, index) in slides">
                <button
                    class="transition bg-gray-100 rounded-full size-2"
                    x-on:click="currentSlideIndex = index + 1"
                    x-bind:class="[currentSlideIndex === index + 1 ? 'bg-primary-600' :
                        'bg-gray-100'
                    ]"
                    x-bind:aria-label="'slide ' + (index + 1)"
                ></button>
            </template>
        </div>
        <x-notification.attachment.image-preview with-controls />
    </div>
@endif
