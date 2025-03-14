<div
    x-show="imagePath"
    class="fixed inset-0 bg-slate-900/50 z-[1]"
    x-cloak
></div>
<div
    x-show="imagePath"
    class="fixed inset-0 z-[99] flex items-center justify-center bg-black bg-opacity-50 select-none cursor-zoom-out"
    x-cloak
>
    <div
        class="relative flex items-center justify-center max-w-[600px] max-h-[600px]"
        x-show="imagePath"
        x-transition.opacity
        x-cloak
    >
        <img
            x-bind:src="imagePath"
            alt="Imagem do Anexo"
            class="object-contain object-center w-full h-full select-none cursor-zoom-out"
            draggable="false"
            width="600"
            height="600"
            @click.away="imagePath = null"
            @keydown.escape.window="imagePath = null"
        />
    </div>
</div>
