<?php

function breadcrumb() { ?>
    <div class="flex space-x-2">
        <a 
            href="#"
            class="
                font-normal text-zinc-700 dark:text-zinc-400 text-sm
                hover:text-black hover:dark:text-white hover:underline
            "
        >
            <i class="bx bx-home"></i>
            Home
        </button>
        <a
            href="#"
            class="
                font-normal hover:underline
                text-zinc-700 dark:text-zinc-400 text-sm
                hover:text-black hover:dark:text-white hover:underline
            "
        >
            <i class="bx bx-list-ul"></i>
            General Discussion
        </a>
    </div><?php
}