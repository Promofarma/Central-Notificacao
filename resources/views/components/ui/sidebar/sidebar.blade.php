<aside
    class="flex flex-col w-full p-4 border-r border-gray-200 bg-gray-100/25 gap-y-8 grow max-w-16 sm:max-w-20 md:max-w-56 xl:max-w-64"
>
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
                            item.classList.add('bg-white', 'text-gray-950', 'shadow', 'shadow-gray-300/10', 'ring-1', 'ring-gray-950/10');
                        }
                    });
                });
            }
        }"
    >

        <div class="text-center md:text-left md:px-3">
            <x-ui.text
                size="xs"
                variant="subtle"
            >Menu</x-ui.text>
        </div>

        @can('view any notification')
            <x-ui.sidebar.item
                :href="route('notification.index')"
                resource="notifications"
                icon="heroicon-s-bell"
            >
                {{ __('Notifications') }}
            </x-ui.sidebar.item>
        @endcan

        @can('view any group')
            <x-ui.sidebar.item
                :href="route('group.index')"
                resource="groups"
                icon="heroicon-s-user-group"
            >
                {{ __('Groups') }}
            </x-ui.sidebar.item>
        @endcan

        @can('view any user')
            <x-ui.sidebar.item
                :href="route('user.index')"
                resource="users"
                icon="heroicon-s-users"
            >
                {{ __('Users') }}
            </x-ui.sidebar.item>
        @endcan

        @can('view any recipient')
            <x-ui.sidebar.item
                :href="route('recipient.index')"
                resource="recipients"
                icon="heroicon-s-envelope"
            >
                {{ __('Recipients') }}
            </x-ui.sidebar.item>
        @endcan

        @can('view any team')
            <x-ui.sidebar.item
                :href="route('team.index')"
                resource="teams"
                icon="heroicon-s-user-group"
            >
                {{ __('Teams') }}
            </x-ui.sidebar.item>
        @endcan

        @can('view any category')
            <x-ui.sidebar.item
                :href="route('category.index')"
                resource="categories"
                icon="heroicon-s-tag"
            >
                {{ __('Categories') }}
            </x-ui.sidebar.item>
        @endcan

        @can('view any role')
            <x-ui.sidebar.item
                :href="route('role.index')"
                resource="roles"
                icon="heroicon-s-shield-check"
            >
                {{ __('Roles') }}
            </x-ui.sidebar.item>
        @endcan

        @can('view any permission')
            <x-ui.sidebar.item
                :href="route('permission.index')"
                resource="permissions"
                icon="heroicon-s-lock-closed"
            >
                {{ __('Permissions') }}
            </x-ui.sidebar.item>
        @endcan

        <hr class="h-px bg-gray-200">

        <x-ui.sidebar.item
            :href="route('logout')"
            resource="logout"
            icon="heroicon-s-lock-closed"
        >
            {{ __('Exit') }}
        </x-ui.sidebar.item>
    </nav>
</aside>
