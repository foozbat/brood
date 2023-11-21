<?php function flash_message() { ?>
    <div
        class="
            w-half
            m-2 p-2 
            text-sm
            bg-green-100 dark:bg-green-900 
            text-zinc-900 dark:text-zinc-300 font-bold
            rounded-md
            border-l-4 border-green-400 dark:border-green-600
        "
        x-data="{ show_message: false }"
        x-show="show_message"
        x-on:flash-message.window="show_message = true"
        x-on:htmx:before-swap.window="show_message = false"
        x-transition
        x-cloak
    >
        here it is
        
    </div>

<?php } ?>