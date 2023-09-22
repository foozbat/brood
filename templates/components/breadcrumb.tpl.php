<?php

function breadcrumb() { ?>
    <div class="flex space-x-2 pb-2">
        <a 
            href="#"
            class="
                font-bold 
                text-zinc-700 dark:text-zinc-400 text-sm
                hover:text-black hover:dark:text-white hover:underline
            "
        >
            <i class="bx bx-home"></i>
            <!--<span class="hidden md:contents">Home</span>-->
            Home
        </button>
        <a
            href="#"
            class="
                font-bold hover:underline
                text-zinc-700 dark:text-zinc-400 text-sm
                hover:text-black hover:dark:text-white hover:underline
            "
        >
            <i class="bx bx-list-ul"></i>
            General Discussion
        </a>
    </div><?php
}