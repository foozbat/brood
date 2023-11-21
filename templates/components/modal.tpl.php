<?php function modal() { ?>

<div
    class="
        flex
        h-screen w-screen
        backdrop-blur bg-black/50
        text-white
        justify-center
        items-center
        absolute
        z-50
    "
    x-data="{ show_modal: false }"
    x-show="show_modal"
    x-on:flash-message.window="show_modal = true"
    x-transition
    x-cloak
>
    <div class="
        flex
        bg-white dark:bg-zinc-800 
        text-zinc-950 dark:text-zinc-300
        rounded-md shadow-md
        border-r-2 border-b-2 border-zinc-300 dark:border-black
        p-2 mb-2
        h-64 w-64
        justify-center items-center
    ">
        <button 
            class="
                rounded-md
                bg-blue-800
                text-white
                font-bold
                px-4 py-2
            "
            @click="show_modal=false"
        >
            Close
        </button>
    </div>
</div>

<?php } ?>