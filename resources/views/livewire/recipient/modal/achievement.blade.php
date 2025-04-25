<x-ui.modal
    height="auto"
    max-width="lg"
>
    <div class="flex flex-col items-center p-6 space-y-4 text-center">
        <x-ui.heading
            level="3"
            size="xl"
        >
            Suas Conquistas
        </x-ui.heading>

        <x-ui.text
            size="sm"
            variant="subtle"
        >
            Aqui estão as conquistas que você desbloqueou até agora. Continue assim!
        </x-ui.text>

        <div class="grid grid-cols-1 gap-4 mt-2 sm:grid-cols-3">

            <div class="relative mx-auto">
                <img
                    src="{{ asset('badges/badge_archived_all.png') }}"
                    alt="Arquivou tudo!"
                    class="object-contain w-32 h-32 transition-transform duration-75 rounded-full hover:scale-110"
                />
                <span
                    class="absolute flex items-center justify-center w-8 h-8 text-sm text-white rounded-full backdrop-blur bottom-2 right-2 bg-black/50"
                >
                    2x
                </span>
            </div>


            <img
                src="{{ asset('badges/badge_empty_inbox.png') }}"
                alt="Caixa de Entrada limpa"
                class="object-contain w-32 h-32 transition-transform duration-75 rounded-full hover:scale-110"
            />

            <img
                src="{{ asset('badges/badge_fast_read.png') }}"
                alt="Leu mensagem, super rápido"
                class="object-contain w-32 h-32 transition-transform duration-75 rounded-full hover:scale-110"
            />
        </div>
    </div>
</x-ui.modal>
