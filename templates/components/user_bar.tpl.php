<?php 

require_once("components/user_icon.tpl.php");

function user_entry($username, $status) { ?>
    <a href="#" class="
        flex 
        w-full 
        space-x-3 pb-1 pt-1 px-1
        rounded-md 
        items-center
        hover:bg-zinc-200 hover:dark:bg-zinc-900 
        hover:text-black hover:dark:text-white
    ">
        <?php user_icon() ?>
        <div>
            <div class="text-sm"><?= $username ?></div>
            <div class="text-xs text-zinc-500"><?= $status ?></div>
        </div>
    </a><?php 
} ?>

<div 
    class="
        flex flex-col
        space-y-1 p-2
        rounded-md border-r-2 border-b-2 
        border-zinc-300 dark:border-black
        shadow-lg
        bg-zinc-100 dark:bg-zinc-950
        text-zinc-800 dark:text-zinc-300
    "
    hx-get="/components/user_bar"
    hx-trigger="user-login-success from:body, user-logout from:body"
    hx-swap="outerHTML"
>
    <div
        class="
            flex justify-center items-center 
            w-full 
            space-x-3 pb-1 pt-1 px-2
            rounded-md 
            hover:bg-zinc-200 hover:text-black 
            hover:dark:bg-zinc-800 hover:dark:text-white
            text-zinc-600 dark:text-zinc-400
            cursor-pointer
        "
        @click="show_user_bar = !show_user_bar"
    >
        <div 
            class="
                inline-flex overflow-hidden 
                justify-center items-center 
                w-[32px] h-[32px] 
                text-2xl
                pr-3
            "
        >
            <i class="bx bxs-user z-10 absolute"></i> 
            <i class="bx bxs-user z-20 absolute text-zinc-200 dark:text-black translate-x-1"></i> 
            <i class="bx bxs-user z-20 absolute translate-x-2"></i>
        </div>
        <span
            class="
                inline-block
                w-full
                align-middle
                uppercase font-bold text-sm 
            "
        >
            Online
        </span>
        <span
            class="
                inline-block
                align-middle
                text-sm font-bold uppercase
            "
        >
            <i class='bx bx-chevrons-right text-2xl' ></i>
        </span>
    </div>
    
    <?php if (!$auth->is_authenticated): ?>
        <div 
            class="
                flex flex-col justify-center items-center 
                w-full h-96
            "
        >
            <button 
                class="
                    bg-blue-800 hover:bg-blue-700 
                    text-sm text-white font-bold 
                    py-2 px-4 rounded-full
                "
                @click="$dispatch('toggle-login-modal')"
            >
                <i class='bx bx-log-in-circle' ></i>
                Login
            </button>
            <br />
            to see who's online.
        </div>
    <?php else: ?>
        <?php for ($i=0; $i<rand(10,sizeof($users)); $i++): ?>
            <?php user_entry($users[$i], "blah"); ?>
        <?php endfor ?>
    <?php endif ?>
        
</div>