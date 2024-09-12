<?php

require_once("components/flash_message.tpl.php");

Fzb\extend("components/modal.tpl.php");

$name = "thread-new";
$content = function () use ($channel_id) { ?>
<div 
    class="
        w-96 max-w-full
        flex flex-col
        bg-white dark:bg-zinc-950 
        text-zinc-950 dark:text-zinc-300
        justify-center
        rounded-md shadow-lg
        border-r-2 border-b-2 border-zinc-300 dark:border-black
        p-4
    "
    @click.away="
        close();
        $dispatch('flash-thread-new-hide');
    "
    
>
    new thread
    <form>
        Title: 
        <input type="text" name="title" />
        <textarea name="content"></textarea>

        <button 
            class="
                rounded-md w-full
                bg-gradient-to-b from-blue-800 hover:from-blue-700 to-blue-900 hover:to-blue-800
                text-white font-bold
                px-4 py-2 mt-4
            "
            hx-post="/thread/new/<?= $channel_id ?>"
            hx-swap="none"
            hx-target="#content_area"
        >
            Post
        </button>
    </form>
</div>
<?php }; ?>