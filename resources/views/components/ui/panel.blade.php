<div class="relative flex h-screen">
    <x-sidebar />

    <!-- Main -->
    <main
        class="flex flex-col flex-1 [&>:nth-child(2)::-webkit-scrollbar]:w-1.5 [&>:nth-child(2)::-webkit-scrollbar-track]:bg-slate-200 [&>:nth-child(2)::-webkit-scrollbar-thumb]:bg-slate-400 [&>:nth-child(2)::-webkit-scrollbar-thumb]:rounded-lg [&>:nth-child(2)]:flex-1 [&>:nth-child(2)]:overflow-y-auto [&>:nth-child(2)]:p-4 [&>:nth-child(2)]:h-0"
    >
        <x-header />

        {{ $slot }}
    </main>
    <!-- Main -->
</div>
