@props([
    'maxHeight' => 'md',
    'maxWidth' => 'md',
    'closeOnEscape' => true,
    'closeOnOutsideClick' => true,
    'showCloseButton' => true,
])

<div
    x-data="{
        isOpen: $wire.entangle('isOpen'),
        close() {
            if (!this.isOpen) return;
            this.isOpen = false;
        },
    }"
    class="fixed inset-0 z-10 bg-slate-900/50"
    x-show="isOpen"
    x-cloak
>
    <!-- Modal Overlay -->
    <div
        x-data="{
            isVisible: false,
            init() {
                this.$nextTick(() => {
                    this.$watch('isOpen', value => this.isVisible = value);
                });
            },
        }"
        class="flex items-center justify-center h-screen px-6 pointer-events-auto md:px-0"
        {!! $closeOnEscape ? '@keydown.escape.window="close()"' : '' !!}
    >
        <!-- Modal Content -->
        <div
            @class([
                'relative flex flex-col w-full bg-white rounded-lg shadow-xl ring-1 ring-slate-200 overflow-auto',
                'md:max-w-xs' => $maxWidth === 'xs',
                'md:max-w-sm' => $maxWidth === 'sm',
                'md:max-w-md' => $maxWidth === 'md',
                'md:max-w-lg' => $maxWidth === 'lg',
                'md:max-w-xl' => $maxWidth === 'xl',
                'md:max-w-2xl' => $maxWidth === '2xl',
                'md:max-w-3xl' => $maxWidth === '3xl',
            ])
            x-show="isVisible"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-cloak
            {!! $closeOnOutsideClick ? '@click.outside="close()"' : '' !!}
        >
            <!-- Close Button -->
            @if ($showCloseButton)
                <x-ui.button
                    aria-label="Fechar"
                    icon="x"
                    color="white"
                    size="small"
                    class="absolute top-3 right-3"
                    @click="close()"
                />
            @endif

            @isset($heading)
                <!-- Modal Header -->
                <header class="p-4">
                    <h3 class="text-lg font-semibold text-slate-800">{{ $heading }}</h3>
                </header>
                <!-- Modal Header -->
            @endisset

            <!-- Modal Body -->
            <div class="p-4">
                {{ $slot }}
            </div>
            <!-- Modal Body -->

            @isset($footer)
                <!-- Modal Footer -->
                <footer class="flex justify-end p-4 bg-slate-50">
                    {{ $footer }}
                </footer>
                <!-- Modal Footer -->
            @endisset
        </div>
        <!-- Modal Content -->
    </div>
    <!-- Modal Overlay -->
</div>
