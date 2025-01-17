@props([
    'activeFilters' => [],
])
<div x-data="{
    filterData: $wire.entangle('filterData'),

    isOpen: false,

    init() {
        $nextTick(() => {
            this.setupTarget();
        })
    },

    setupTarget() {
        const target = $refs.target;

        if (!target) {
            return;
        }

        target.addEventListener('click', () => {
            this.isOpen = !this.isOpen;
        });
    },

    isFilled() {
        return this.checkPropertiesIsFilled(this.filterData);
    },

    checkPropertiesIsFilled(obj) {
        return Object.values(obj).some((value) => {
            if (Array.isArray(value)) {
                return value.length > 0;
            }

            if (typeof value === 'object' && value !== null) {
                return this.checkPropertiesIsFilled(value);
            }

            return value !== null && value !== '';
        });
    }
}">
    @isset($target)
        {!! $target !!}
    @endisset

    <x-filter.active-filters :$activeFilters />

    {{ $slot }}
</div>
