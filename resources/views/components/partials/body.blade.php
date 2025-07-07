<body class="text-base antialiased text-gray-950 bg-gray-50">
    {{ $slot }}


    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

    @livewire('notifications')

    @filamentScripts
    @vite('resources/js/app.js')
</body>
