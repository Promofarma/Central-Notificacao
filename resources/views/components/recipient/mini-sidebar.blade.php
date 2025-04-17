<div class="flex bg-white flex-col w-full border-r gap-y-4 shrink-0 max-w-[5.5rem] border-gray-200">
    <header class="grid bg-white border-b border-gray-200 h-14 place-content-center shrink-0">
        <a href="{{ route('recipient.index', $recipientId) }}">
            <figure class="w-10 h-10 rounded-full shadow-sm bg-primary-600">
                <img
                    src="{{ asset('logo.webp') }}"
                    alt="Logo Promofarma"
                    class="object-contain w-full h-full max-w-10 max-h-10"
                    loading="lazy"
                    draggable="false"
                >
            </figure>
        </a>
    </header>
    <nav class="flex flex-col items-center gap-y-4">
        <x-recipient.mini-sidebar-button
            tabId="inbox"
            icon="heroicon-s-inbox"
            label="Caixa de Entrada"
            @click="tab = 'inbox'"
        />
        <x-recipient.mini-sidebar-button
            tabId="archived"
            icon="heroicon-s-archive-box"
            label="Arquivadas"
            @click="tab = 'archived'"
        />
        <x-recipient.mini-sidebar-button
            tabId="filters"
            icon="heroicon-s-funnel"
            label="Filtros"
            @click="tab = 'filters'"
        />
    </nav>
</div>
