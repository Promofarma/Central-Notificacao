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
            class="absolute z-20 flex items-center justify-center p-2 transition -translate-y-1/2 rounded-full left-5 top-1/2 bg-surface/40 text-on-surface hover:bg-surface/60 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:outline-offset-0 dark:bg-surface-dark/40 dark:text-on-surface-dark dark:hover:bg-surface-dark/60 dark:focus-visible:outline-primary-dark"
            aria-label="previous slide"
            x-on:click="previous()"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                stroke="currentColor"
                fill="none"
                stroke-width="3"
                class="size-5 md:size-6 pr-0.5"
                aria-hidden="true"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15.75 19.5 8.25 12l7.5-7.5"
                />
            </svg>
        </button>

        <button
            type="button"
            class="absolute z-20 flex items-center justify-center p-2 transition -translate-y-1/2 rounded-full right-5 top-1/2 bg-surface/40 text-on-surface hover:bg-surface/60 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:outline-offset-0 dark:bg-surface-dark/40 dark:text-on-surface-dark dark:hover:bg-surface-dark/60 dark:focus-visible:outline-primary-dark"
            aria-label="next slide"
            x-on:click="next()"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                stroke="currentColor"
                fill="none"
                stroke-width="3"
                class="size-5 md:size-6 pl-0.5"
                aria-hidden="true"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M8.25 4.5l7.5 7.5-7.5 7.5"
                />
            </svg>
        </button>
        <div class="relative min-h-[50svh] w-full">
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
            class="absolute rounded-radius bottom-3 md:bottom-5 left-1/2 z-20 flex -translate-x-1/2 gap-4 md:gap-3 bg-surface/75 px-1.5 py-1 md:px-2"
            role="group"
            aria-label="slides"
        >
            <template x-for="(slide, index) in slides">
                <button
                    class="transition bg-gray-400 rounded-full size-2"
                    x-on:click="currentSlideIndex = index + 1"
                    x-bind:class="[currentSlideIndex === index + 1 ? 'bg-gray-400' :
                        'bg-gray-400/50'
                    ]"
                    x-bind:aria-label="'slide ' + (index + 1)"
                ></button>
            </template>
        </div>
        <x-notification.attachment.image-preview />
    </div>
@endif
