<head>
    <meta charset="utf-8">

    <meta
        name="application-name"
        content="{{ config('app.name') }}"
    >
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        @if ($title)
            {{ $title }} - {{ config('app.name') }}
        @else
            {{ config('app.name') }}
        @endif
    </title>

    <link
        rel="preconnect"
        href="https://fonts.bunny.net"
    />
    <link
        href="https://fonts.bunny.net/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet"
    />

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('favicon.png') }}"
    >

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <link
        rel="stylesheet"
        href="https://printjs-4de6.kxcdn.com/print.min.css"
    >

    @filamentStyles
    @vite('resources/css/app.css')
</head>
