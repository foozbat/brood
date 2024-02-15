<?php

require_once("components/modals/modal.tpl.php");

$login_modal = function () { ?>
<div class="
    flex flex-col
    bg-white dark:bg-zinc-800 
    text-zinc-950 dark:text-zinc-300
    rounded-md shadow-md
    border-r-2 border-b-2 border-zinc-300 dark:border-black
    p-10 mb-2

    justify-center items-center
">
    <form action="/login" method="get">
        <input type="text" name="username" />
        <input type="password" name="password" />
        <input type="submit">
    </form>

    <hr>

    <button 
        class="
            rounded-md
            bg-blue-800
            text-white
            font-bold
            px-4 py-2
        "
        @click="toggle"
    >
        Close
    </button>
</div><?php
};