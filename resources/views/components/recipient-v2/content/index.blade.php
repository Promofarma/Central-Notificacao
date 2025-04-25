<main class="flex flex-col flex-1">
    <header class="p-4 mb-4 shrink-0 h-14">
        <x-ui.heading level="2">Resumo das notificações</x-ui.heading>
        <x-ui.text size="sm">Visualize um resumo das notificações recentes.</x-ui.text>
    </header>


    <div class="flex-1 h-px p-4 overflow-y-auto">

        <div class="mb-4 space-y-4 last:mb-0">
            <x-ui.badge level="3">Hoje</x-ui.badge>

            <x-recipient-v2.content.resume.item />

        </div>

    </div>
</main>
