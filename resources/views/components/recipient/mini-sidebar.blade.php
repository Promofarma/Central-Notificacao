<div class="flex flex-col w-full border-r gap-y-4 shrink-0 max-w-[4rem] border-slate-200">
    <header class="grid bg-white border-b h-14 place-content-center shrink-0 border-slate-200">
        <figure class="w-10 h-10 rounded-lg shadow-sm bg-primary-500 shadow-slate-300/10">
            <img
                src="{{ Vite::asset('public/logo.webp') }}"
                alt="Logo Promofarma"
                class="object-contain w-full h-full"
                loading="lazy"
                draggable="false"
            >
        </figure>
    </header>
    <nav class="flex flex-col items-center gap-y-4">
        <x-recipient.mini-sidebar-button
            tabId="inbox"
            icon-name="inbox"
            label="Caixa de Entrada"
            @click="tab = 'inbox'"
        />
        <x-recipient.mini-sidebar-button
            tabId="filters"
            icon-name="filter"
            label="Filtros"
            @click="tab = 'filters'"
        />
    </nav>
</div>
