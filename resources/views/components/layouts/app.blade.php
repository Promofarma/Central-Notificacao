<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-partials.head :$title />

<x-partials.body>
    <x-ui.panel>
        {{ $slot }}
    </x-ui.panel>
</x-partials.body>

</html>
