<?php 
/**
 * Page Header Component
 */

require_once("components/user_icon.tpl.php");
require_once("components/modal.tpl.php");
require_once("components/breadcrumb.tpl.php");

?>
<div 
    class="
        flex w-full h-16 lg:h-24
        items-end justify-between p-2
        bg-gradient-to-b from-black to-transparent
        text-black dark:text-white
        space-x-2
    "
    x-show="!$store.ui.mobile_keyboard_active"
>

<!--  bg-gradient-to-b from-white dark:from-black to-transparent -->
    <a 
        href="/"
        hx-get="/"
        hx-target="#content_area"
        hx-push-url="true"
        hx-swap="innerHTML"
    >
        <div class="flex items-end">
            <img src="static/brood_light.png" class="h-[40px] w-[40px] dark:hidden">
            <img src="static/brood_dark.png" class="h-[40px] w-[40px] hidden dark:block">
            <span class="text-2xl lg:text-3xl pl-2 font-logo"> brood</span>
        </div>
    </a>

    <div class="flex justify-center w-full">
        
    </div>

    <!-- search button -->
    <div x-data="{ show_search_box: false }">
        <div 
            class="
                inline-flex overflow-hidden 
                justify-center items-center 
                w-[40px] h-[40px] 
                text-2xl
                cursor-pointer
            "
            @click="$dispatch('toggle-search-bar')"
        >
            <i class='bx bx-search' ></i>
        </div>
    </div>
    
    <!-- forum list button -->
    <div class="flex items-end">
        <div 
            class="
                inline-flex overflow-hidden 
                justify-center items-center 
                w-[40px] h-[40px] 
                text-3xl
                cursor-pointer
            "
            
            @click="$dispatch('toggle-main-bar')"
        >
            <i class='bx bx-menu' ></i>
        </div>
    </div>

    <!-- user list button -->
    <div class="flex">
        <div 
            class="
                inline-flex overflow-hidden 
                justify-center items-center 
                w-[40px] h-[40px] 
                text-2xl
                cursor-pointer
            "
            
            @click="$dispatch('toggle-user-bar')"
        >
        <i class='bx bx-group' ></i>
        </div>
    </div>

    <!-- profile button -->
    <?php if ($auth->is_authenticated): ?>
        <div x-data="dropdown">
            <button 
                type="button" 
                @click="toggle()" 
                @click.away="click_away()"
            >
                <?php user_icon(size: 40) ?>
            </button>

            <!-- profile dropdown -->
            <div 
                class="
                    absolute 
                    right-2 mt-1 w-48
                    divide-y divide-zinc-200 dark:divide-zinc-900
                    rounded-md 
                    border border-zinc-200 dark:border-zinc-800
                    bg-white dark:bg-black
                    text-md text-zinc-800 dark:text-zinc-200
                    shadow-lg
                    z-50
                "
                x-cloak
                x-show="open" 
                x-transition
            >
                <div class="
                    flex items-center 
                    space-x-2 p-2 text-sm 
                    font-bold
                ">
                    <?= $auth->user->username ?>
                </div>

                <div class="flex flex-col">
                    <a 
                        href="#" 
                        class="
                            p-2
                            transition
                            hover:text-black hover:dark:text-white
                            hover:bg-zinc-100 hover:dark:bg-zinc-900
                        "
                    >
                        <i class='bx bxs-user'></i> Profile
                    </a>
                    <a 
                        href="#" 
                        class="
                            p-2
                            transition
                            hover:text-black hover:dark:text-white
                            hover:bg-zinc-100 hover:dark:bg-zinc-950
                        "
                    >
                        <i class='bx bxs-cog' ></i> Settings
                    </a>
                </div>

                <div class="flex flex-col">
                    <a 
                        href="#"
                        hx-get="/logout"
                        hx-swap="none" 
                        class="
                            p-2
                            transition
                            hover:text-black hover:dark:text-white
                            hover:bg-zinc-400 hover:dark:bg-zinc-700/50
                        "
                    >
                        <i class='bx bx-log-out' ></i> Log Out
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="flex">
            <a 
                href="#"
                class="
                    w-[40px] h-[40px] 
                    inline-flex overflow-hidden 
                    justify-center items-center 
                "
                <?php hx_modal("/login") ?>
                @click="$nextTick(() => $dispatch('show-modal'))"
            >
                <i class='bx bx-log-in-circle text-3xl' ></i>
            </a>
        </div>
    <?php endif ?>
</div>