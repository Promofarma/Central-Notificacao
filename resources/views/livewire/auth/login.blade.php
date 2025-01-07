<main class="flex items-center justify-center h-screen">
    <section class="w-full max-w-lg p-16 space-y-8">
        <header>
            <h1 class="text-xl font-bold">{{ $title }}</h1>
            <p class="text-sm font-medium text-slate-500">Insira seus dados para continuar</p>
        </header>

        <form
            id="login-form"
            wire:submit="handleFormSubmit"
            novalidate
        >
            {{ $this->form }}
        </form>

        <x-ui.button
            type="submit"
            form="login-form"
            size="large"
            full-size
            wire-target="handleFormSubmit"
        >Acessar minha conta</x-ui.button>
    </section>
</main>
