<main class="flex flex-col items-center justify-center h-screen">
    <section class="w-full max-w-lg p-12 space-y-6">
        <header class="flex flex-col items-center gap-y-3">
            <figure class="grid w-12 h-12 rounded-full shadow place-content-center bg-primary-500">
                <img
                    src="{{ asset('logo.webp') }}"
                    class="object-contain w-full h-full"
                    alt="Logo Promofarma"
                    loading="lazy"
                    draggable="false"
                />
            </figure>
            <div class="space-y-1 text-center">
                <x-ui.heading
                    level="1"
                    size="lg"
                >{{ $title }}</x-ui.heading>
                <x-ui.text
                    size="xs"
                    variant="subtle"
                >Insira seus dados para continuar</x-ui.text>
            </div>
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
            size="lg"
            full-size
            wire-target="handleFormSubmit"
        >
            Acessar minha conta
        </x-ui.button>
    </section>
    <p class="text-xs text-slate-500">Promofarma &copy; {{ now()->year }} - <strong>{{ config('app.name') }}</strong>.
    </p>
</main>
