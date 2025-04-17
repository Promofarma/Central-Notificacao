@props([
    'maxWidth' => '5xl',
    'height' => 'min',
    'closeByEscaping' => true,
    'closeByOutside' => true,
])

<div
    x-data="{
        isOpen: @entangle('isOpen'),
        isShown: false,
        init() {
            this.$watch('isOpen', (value) => {
                this.isShown = value;
            });
        }
    }"
    x-ref="modal"
    aria-modal="true"
    role="dialog"
>

    <div
        x-show="isOpen"
        x-cloak
    >
        <div
            class="fixed inset-0 z-40 bg-gray-950/50"
            x-show="isOpen"
            x-transition.opacity.duration.300ms
            aria-hidden="true"
        ></div>
        <div class="fixed inset-0 z-40 overflow-y-auto">
            <div class="relative flex items-center justify-center min-h-full px-4">
                <div
                    x-show="isShown"
                    @if ($closeByEscaping) x-on:keydown.escape.window="isOpen = false" @endif
                    @if ($closeByOutside) x-on:click.outside="isOpen = false" @endif
                    x-transition:enter="duration-300 ease-out"
                    x-transition:enter-start="scale-95 opacity-0"
                    x-transition:enter-end="scale-100 opacity-100"
                    x-transition:leave="duration-300 ease-in"
                    x-transition:leave-start="scale-100 opacity-100"
                    x-transition:leave-end="scale-95 opacity-0"
                    @class([
                        'relative w-full flex flex-col bg-white shadow-sm cursor-default pointer-events-auto rounded-lg ring-1 shadow-lg ring-gray-300',
                        'max-w-xs' => $maxWidth === 'xs',
                        'max-w-sm' => $maxWidth === 'sm',
                        'max-w-md' => $maxWidth === 'md',
                        'max-w-lg' => $maxWidth === 'lg',
                        'max-w-xl' => $maxWidth === 'xl',
                        'max-w-2xl' => $maxWidth === '2xl',
                        'max-w-3xl' => $maxWidth === '3xl',
                        'max-w-4xl' => $maxWidth === '4xl',
                        'max-w-5xl' => $maxWidth === '5xl',
                        'max-w-6xl' => $maxWidth === '6xl',
                        'max-w-7xl' => $maxWidth === '7xl',
                        'h-[calc(100vh-8rem)]' => $height === 'min',
                    ])
                >
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

</div>
