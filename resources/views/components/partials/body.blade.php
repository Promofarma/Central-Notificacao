<body class="text-base antialiased text-gray-950 bg-gray-50">
    {{ $slot }}

    @livewire('notifications')

    @filamentScripts
    @vite('resources/js/app.js')
</body>
