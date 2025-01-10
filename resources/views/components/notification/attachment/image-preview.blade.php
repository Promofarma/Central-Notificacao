<div
    x-show="imagePath"
    class="fixed inset-0 bg-slate-900/50 z-[1]"
    x-cloak
></div>
<div
    x-show="imagePath"
    class="fixed inset-0 flex items-center justify-center z-[2]"
    x-cloak
>
    <div
        class="absolute max-w-[50%] max-h-[50%] pointer-events-none"
        x-show="imagePath"
        x-transition.opacity
        x-cloak
    >
        <img
            x-show="imagePath"
            x-bind:src="imagePath"
            alt="Imagem do Anexo"
            class="object-contain w-full h-full !cursor-zoom-out"
            draggable="false"
            @click.away="imagePath = null"
            @keydown.escape.window="imagePath = null"
        />
    </div>
</div>
