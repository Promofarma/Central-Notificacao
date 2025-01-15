<!-- Sidebar -->
<aside class="flex flex-col sm:p-4 gap-y-6 grow w-full max-w-16 sm:max-w-20 md:max-w-56 xl:max-w-64">
    <!-- Navigation -->
    <nav
        class="flex flex-col flex-1 gap-y-3"
        x-data="{
            currentUrl: '{{ url()->current() }}',
            init() {
                this.$nextTick(() => {
                    const items = this.$el.querySelectorAll('a');
                    Array.from(items).forEach(item => {
                        const currentUrl = this.currentUrl;
                        const resourceName = item.getAttribute('resource-name');

                        if (this.currentUrl.includes(resourceName)) {
                            item.classList.add('bg-white', 'text-slate-900', 'shadow', 'shadow-slate-300/10', 'ring-1', 'ring-slate-200');
                        }
                    });
                });
            }
        }"
    >
        <!-- Section Header -->
        <h3 class="text-xs font-medium tracking-wide text-center md:text-start md:px-3 text-slate-500">Menu
        </h3>

        <!-- Links -->
        <a
            href="{{ route('dashboard') }}"
            resource-name="dashboard"
            class="flex items-center text-sm px-3 py-2 md:gap-3 justify-center md:justify-start rounded-lg font-medium text-slate-500 transition-colors duration-150 hover:bg-white hover:shadow-sm hover:shadow-slate-300/10 hover:ring-1 hover:ring-slate-200 hover:text-slate-900 focus:outline-none [&>svg]:size-5"
        >
            <x-heroicon-s-home />
            <span class="hidden md:block">Dashboard</span>
        </a>

        <a
            href="{{ route('notification.index') }}"
            resource-name="notification"
            class="flex items-center text-sm px-3 py-2 md:gap-3 justify-center md:justify-start rounded-lg font-medium text-slate-500 transition-colors duration-150 hover:bg-white hover:shadow-sm hover:shadow-slate-300/10 hover:ring-1 hover:ring-slate-200 hover:text-slate-900 focus:outline-none [&>svg]:size-5"
        >
            <x-heroicon-s-bell />
            <span class="hidden md:block">Notificações</span>
        </a>

        <hr class="h-px bg-slate-200">

        <a
            href="{{ route('logout') }}"
            resource-name="logout"
            class="flex items-center text-sm px-3 py-2 md:gap-3 justify-center md:justify-start rounded-lg font-medium text-slate-500 transition-colors duration-150 hover:bg-white hover:shadow-sm hover:shadow-slate-300/10 hover:ring-1 hover:ring-slate-200 hover:text-slate-900 focus:outline-none [&>svg]:size-5"
        >
            <x-heroicon-s-lock-closed />
            <span class="hidden md:block">Sair</span>
        </a>
    </nav>
</aside>
<!-- Sidebar -->
