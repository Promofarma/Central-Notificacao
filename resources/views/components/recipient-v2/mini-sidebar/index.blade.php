<div class="flex flex-col bg-white max-w-20 grow">
    <div class="flex items-center justify-center border-b h-14 border-gray-950/10">
        <a
            href="{{ route('recipient', ['recipient' => $recipient]) }}"
            class="flex items-center justify-center w-10 h-10 rounded-full bg-primary-600"
        >
            <img
                src="{{ asset('logo.webp') }}"
                alt="Logo Promofarma"
                class="object-contain w-full h-full max-w-10 max-h-10"
                loading="lazy"
                draggable="false"
            >
        </a>
    </div>
    <nav class="flex flex-col items-center flex-1 mt-4 space-y-4">
        <x-recipient-v2.mini-sidebar.nav-item
            text="Caixa de Entrada"
            icon="heroicon-s-inbox"
            @click="$wire.tab === 'inbox' ? false : $wire.set('tab', 'inbox');"
            x-bind:data-active="$wire.tab === 'inbox'"
            wire:loading.attr="disabled"
            wire:target="tab"
        />
        <x-recipient-v2.mini-sidebar.nav-item
            text="Arquivadas"
            icon="heroicon-s-archive-box"
            @click="$wire.tab === 'archived' ? false : $wire.set('tab', 'archived');"
            x-bind:data-active="$wire.tab === 'archived'"
            wire:loading.attr="disabled"
            wire:target="tab"
        />
        <x-recipient-v2.mini-sidebar.nav-item
            text="Filtros"
            icon="heroicon-s-funnel"
            :count="$this->countFilteredData"
            @click="$wire.dispatchTo('recipient.drawer.filter', 'open-drawer')"
        />
    </nav>

    <!-- Achivements Not implemented -->
    {{-- <button
        class="inline-flex items-center justify-center w-10 h-10 mx-auto mb-2 text-gray-500 transition duration-150 bg-gray-200 rounded-full cursor-pointer active:scale-110 hover:scale-105 hover:bg-primary-400/20 hover:text-primary-700 shrink-0"
        @click="$wire.dispatchTo('recipient.modal.achievement', 'open-modal', { recipient: 1 })"
    >
        <x-heroicon-m-trophy class="w-5 h-5 shrink-0" />
    </button> --}}
    <!-- Achivements Not implemented -->
</div>
