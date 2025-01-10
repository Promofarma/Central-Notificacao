<div class="relative h-screen">
    <x-header />
    <div class="relative flex gap-6 px-6 h-[calc(100%-3.5rem)]">
        <x-sidebar />
        <!-- Main -->
        <main
            class="flex flex-col flex-1 [&>:first-child::-webkit-scrollbar]:w-1.5 [&>:first-child::-webkit-scrollbar-track]:bg-slate-200 [&>:first-child::-webkit-scrollbar-thumb]:bg-slate-400 [&>:first-child::-webkit-scrollbar-thumb]:rounded-lg [&>:first-child]:flex-1 [&>:first-child]:overflow-y-auto [&>:first-child]:py-4 [&>:first-child]:px-0.5 [&>:first-child]:h-0"
        >
            {{ $slot }}
        </main>
        <!-- Main -->
    </div>
</div>
