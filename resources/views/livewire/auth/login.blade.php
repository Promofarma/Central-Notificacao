<main class="flex flex-col items-center justify-center h-screen">
    <section class="w-full max-w-lg p-12 space-y-6">
        <header class="flex items-center gap-x-3">
            <figure class="grid rounded-lg shadow ring-2 ring-primary-200 place-content-center size-11 bg-primary-500">
                <img
                    src="{{ asset('logo.webp') }}"
                    class="object-contain w-full h-full"
                    alt="Logo Promofarma"
                    loading="lazy"
                    draggable="false"
                />
            </figure>
            <div class="space-y-0.5">
                <h1 class="text-xl font-bold tracking-tight">{{ $title }}</h1>
                <p class="text-xs text-slate-500">Insira seus dados para continuar.</p>
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
