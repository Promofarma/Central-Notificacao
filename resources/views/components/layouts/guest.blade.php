<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-partials.head :$title />

<x-partials.body>
    {{ $slot }}
</x-partials.body>

</html>
