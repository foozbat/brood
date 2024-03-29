<?php
/**
 * Main Forum Landing Template
 */

Fzb\extend("layouts/app_main.tpl.php");

require_once "components/flash_message.tpl.php";

$content = function () use ($posts) { ?>
<div 
    id="main_page"
    class="w-full p-2"
>
    <div class="flex flex-col">
        <p class="text-2xl lg:text-3xl pb-2">
            The Main Page
        </p>

        <?php flash_message() ?>

        <div class="
            flex flex-wrap lg:flex-nowrap w-full space-x-3 
            bg-white dark:bg-zinc-800 
            text-zinc-950 dark:text-zinc-300
            rounded-md
            border-r-2 border-b-2 border-zinc-300 dark:border-black
            p-3 mb-2
        ">
            "Super Awesome Content Area" which will show featured posts.
        </div>

        <div class="
            flex flex-wrap lg:flex-nowrap w-full space-x-3 
            bg-white dark:bg-zinc-800 
            text-zinc-950 dark:text-zinc-300
            rounded-md
            border-r-2 border-b-2 border-zinc-300 dark:border-black
            p-3 mb-2
        ">
            "Super Awesome Content Area" which will show featured chats.
        </div>

        <div class="
            flex flex-wrap lg:flex-nowrap w-full space-x-3 
            bg-white dark:bg-zinc-800 
            text-zinc-950 dark:text-zinc-300
            rounded-md
            border-r-2 border-b-2 border-zinc-300 dark:border-black
            p-3 mb-2
        ">
            "Super Awesome Content Area" which will show featured streams.
        </div>

    </div>
</div>
<?php
};