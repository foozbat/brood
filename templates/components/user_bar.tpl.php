<?php 

function user_entry($username, $status) { ?>
    <a href="#" class="
        flex items-center 
        w-full 
        space-x-3 pb-1 pt-1 px-2
        rounded-md 
        hover:bg-zinc-100 hover:dark:bg-zinc-900
    ">
        <div class="
            inline-flex overflow-hidden relative 
            justify-center items-center 
            w-8 h-8 
            rounded-md
            bg-zinc-100 dark:bg-zinc-600">
            <span class="text-sm text-zinc-600 dark:text-zinc-300">DT</span> 
        </div>
        <div>
            <div class="text-sm"><?= $username ?></div>
            <div class="text-xs text-zinc-500"><?= $status ?></div>
        </div>
    </a><?php 
} ?>

<div class="
    flex flex-col
    space-y-1 p-2
    rounded-md border-r-2 border-b-2 
    border-zinc-300 dark:border-black
    bg-zinc-200 dark:bg-zinc-950
    text-zinc-800 dark:text-zinc-300
">
    <span class="text-lg pb-2">
        <i class="bx bxs-chevron-right"></i>
        <i class="bx bxs-user"></i>
        Online Now
    </span>
    
    <?php 
        foreach ($users as $user) { 
            user_entry($user, "blah");
        }
    ?>
</div>