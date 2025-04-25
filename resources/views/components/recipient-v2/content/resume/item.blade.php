<div class="flex p-4 bg-white rounded-lg shadow-sm gap-x-4 ring-1 ring-gray-950/5">
    <div class="inline-flex flex-col items-center justify-center p-2 bg-gray-100 rounded-lg shrink-0">
        <x-ui.text size="sm">1 dias</x-ui.text>
        <x-ui.text
            size="xs"
            variant="subtle"
        >22/04/2024</x-ui.text>
    </div>
    <div class="flex items-center justify-between flex-1 gap-x-4">
        <div class="space-y-1.5">
            <x-ui.heading
                level="4"
                size="lg"
            >
                title
            </x-ui.heading>
            <x-ui.text
                size="sm"
                class="line-clamp-2"
            >Esse hint ignora locks e pode trazer dados ainda não
                confirmados. Use com cuidado. Pode ser aceitável dependendo do cenário, mas não
                é
                recomendado em tabelas críticas como </x-ui.text>
        </div>

        <x-ui.button
            class="shrink-0"
            size="sm"
            color="gray"
        >Visualizar</x-ui.button>

    </div>
</div>
