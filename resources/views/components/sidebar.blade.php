<!-- Sidebar -->
<aside
    class="flex flex-col border-r bg-white/85 sm:p-4 gap-y-6 grow max-w-16 sm:max-w-20 md:max-w-56 xl:max-w-64 border-slate-200/85"
>
    <!-- Header -->
    <header class="flex items-center justify-center gap-3 md:ps-2 md:justify-start shrink-0">
        <div
            class="inline-flex items-center justify-center rounded-lg text-primary-600 size-8 bg-primary-100 ring-1 ring-primary-200 shrink-0">
            <x-lucide-box class="size-5" />
        </div>
        <h1 class="hidden text-sm font-semibold text-slate-900 md:block">
            {{ config('app.name') }}
        </h1>
    </header>

    <!-- Navigation -->
    <nav
        class="flex flex-col flex-1 gap-y-4"
        x-data="{
            currentUrl: '{{ url()->current() }}',
            init() {
                this.$nextTick(() => {
                    const items = this.$el.querySelectorAll('a');
                    Array.from(items).forEach(item => {
                        const href = item.getAttribute('href');
                        if (href.includes(this.currentUrl)) {
                            item.classList.add('bg-slate-100', 'text-slate-900');
                        }
                    });
                });
            }
        }"
    >
        <!-- Section Header -->
        <h3 class="text-xs font-bold tracking-wide text-center uppercase md:text-start md:px-3 text-slate-500">Menu
        </h3>

        <!-- Links -->
        <a
            href="{{ route('dashboard') }}"
            class="flex items-center text-sm px-3 py-2 md:gap-3 justify-center md:justify-start rounded-lg font-medium text-slate-500 transition-colors duration-150 hover:bg-slate-100 hover:text-slate-900 focus:outline-none [&>svg]:size-5"
        >
            <x-heroicon-s-home />
            <span class="hidden md:block">Dashboard</span>
        </a>

        <a
            href="#"
            class="flex items-center text-sm px-3 py-2 md:gap-3 justify-center md:justify-start rounded-lg font-medium text-slate-500 transition-colors duration-150 hover:bg-slate-100 hover:text-slate-900 focus:outline-none [&>svg]:size-5"
        >
            <x-heroicon-s-bell />
            <span class="hidden md:block">Notificações</span>
        </a>

        <a
            href="{{ route('logout') }}"
            class="flex items-center text-sm px-3 py-2 md:gap-3 justify-center md:justify-start rounded-lg font-medium text-slate-500 transition-colors duration-150 hover:bg-slate-100 hover:text-slate-900 focus:outline-none [&>svg]:size-5"
        >
            <x-heroicon-s-lock-closed />
            <span class="hidden md:block">Sair</span>
        </a>
    </nav>
</aside>
<!-- Sidebar -->
