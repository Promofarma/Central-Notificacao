<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-partials.head />

<x-partials.body>
    {{ $slot }}
</x-partials.body>

</html>
