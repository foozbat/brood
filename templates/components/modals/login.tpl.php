<?php

require_once("components/modals/modal.tpl.php");

$login_modal = function () { ?>
<div 
    class="
        flex flex-col
        bg-white dark:bg-zinc-950 
        text-zinc-950 dark:text-zinc-300
        rounded-md shadow-lg
        border-r-2 border-b-2 border-zinc-300 dark:border-black
        p-10 mb-2
    "
    @click.away="close"
    x-on:user-login-success.document="close"
>
    <h1 class="text-2xl pb-4">Log in</h1>


    <form action="/login" method="post">
        <label for="username" class="block text-sm font-medium leading-6">Username</label>
        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-zinc-400 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
            <span class="flex select-none items-center pl-3">@</span>
            <input 
                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 placeholder:text-zinc-500 dark:placeholder:text-zinc-400 focus:ring-0 sm:text-sm sm:leading-6"
                type="text" 
                name="username" 
                autocomplete="username"  
                placeholder="username"
            />
        </div>

        <label for="password" class="block text-sm font-medium leading-6 pt-2">Password</label>
        <input 
            type="password" 
            class="block w-full rounded-md border-0 bg-transparent py-1.5 shadow-sm ring-1 ring-inset ring-zinc-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" 
            name="password" />
        
        <button 
            class="
                rounded-md
                bg-blue-800
                text-white
                font-bold
                px-4 py-2 mt-2
            "
            hx-post="/login"
            hx-swap="none"
        >
            Login
        </button>

    </form>
</div><?php
};