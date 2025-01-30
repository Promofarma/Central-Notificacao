@props([
    'categories' => [],
])
<section class="flex items-center flex-1">
    <div class="max-w-2xl mx-auto">
        <header class="mb-4 text-center">
            <h1 class="text-lg font-bold text-slate-700">Assuntos que você verá na sua Caixa de Entrada</h1>
            <p class="text-sm text-slate-600">
                Confira os tópicos que estarão disponíveis para você.
            </p>
        </header>
        <div class="grid grid-cols-2 gap-4">
            @foreach ($categories as $name)
                <div
                    class="flex items-center gap-2 p-4 bg-white border rounded-lg shadow-sm border-slate-200 shadow-slate-300/10 last:col-span-full">
                    <div class="inline-flex items-center justify-center bg-green-100 rounded-full size-6">
                        <x-lucide-check class="size-4 stroke-green-600" />
                    </div>
                    <span class="text-sm font-bold">{{ $name }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>
