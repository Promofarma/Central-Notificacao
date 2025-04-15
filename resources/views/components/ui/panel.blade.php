<div class="flex flex-col h-screen">
    <x-header />
    <div class="flex flex-1 overflow-hidden">
        <x-ui.sidebar />
        <main class="flex-1 p-6 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>
</div>
