<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-data="{ state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath()}')") }} }"
        class="overflow-hidden divide-y rounded-lg shadow-sm ring-1 ring-gray-950/10 divide-gray-950/10"
    >
        @foreach ($getOptions() as $state => $label)
            <div
                class="flex items-center gap-4 p-2 transition duration-75 bg-white cursor-pointer hover:opacity-100"
                x-bind:class="state === '{{ $state }}' ? 'opacity-100' : 'opacity-50'"
                @click="state = '{{ $state }}'"
                wire:key="{{ $state }}"
            >
                @if ($hasIcon($state))
                    <div
                        class="inline-flex items-center justify-center text-gray-500 bg-gray-100 rounded-full shrink-0 w-11 h-11">
                        <x-dynamic-component
                            name="icon"
                            :component="$getIcon($state)"
                            class="w-6 h-6 shrink-0"
                        />
                    </div>
                @endif
                <div class="flex-1 space-y-0.5">
                    <x-ui.heading>{{ $label }}</x-ui.heading>
                    @if ($hasDescription($state))
                        <x-ui.text
                            size="sm"
                            variant="subtle"
                        >{{ $getDescription($state) }}</x-ui.text>
                    @endif
                </div>
                <div
                    class="inline-flex items-center justify-center w-6 h-6 mr-2 rounded-full shrink-0 ring-2"
                    x-bind:class="state === '{{ $state }}' ? 'bg-primary-600 text-white ring-primary-600' : 'ring-gray-200'"
                >
                    <x-heroicon-s-check
                        class="w-4 h-4 shrink-0"
                        x-show="state === '{{ $state }}'"
                        x-cloak
                    />
                </div>
            </div>
        @endforeach

        <input
            type="hidden"
            :value="state"
        />
    </div>
</x-dynamic-component>
