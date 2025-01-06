<body class="text-base antialiased bg-slate-100 text-slate-900">
    {{ $slot }}

    @livewire('notifications')

    @filamentScripts
    @vite('resources/js/app.js')
</body>
