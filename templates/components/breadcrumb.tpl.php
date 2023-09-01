<?php

function breadcrumb() { ?>
    <div class="flex">
        <button 
            class="
                py-1 px-4 mr-1
                rounded-full
                bg-zinc-100 dark:bg-zinc-950
                text-sm
                hover:bg-zinc-300 hover:text-black 
                hover:dark:bg-zinc-700 hover:dark:text-white
            "
        >
            <i class="bx bx-home"></i>
            <span class="hidden md:contents">Home</span>
        </button>
        <button
            class="
                py-1 px-4 mr-1
                rounded-full
                bg-zinc-100 dark:bg-zinc-950
                text-sm
                hover:bg-zinc-300 hover:text-black 
                hover:dark:bg-zinc-700 hover:dark:text-white
            "
        >
            <i class="bx bx-list-ul"></i>
            General Discussion
        </button>
    </div><?php
}