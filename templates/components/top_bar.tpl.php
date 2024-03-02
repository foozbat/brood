<?php 
/**
 * Page Header Component
 */

require_once("components/user_icon.tpl.php");
require_once("components/modals/login.tpl.php");   

$top_bar_height = "4";
 
?>
<div 
    class="
        flex w-full
        items-center justify-between p-2
        shadow-lg
        text-zinc-100 
        bg-gradient-to-b from-black to-transparent
        space-x-2
    "
    hx-get="/components/top_bar"
    hx-trigger="user-login-success from:body, user-logout from:body"
    hx-swap="outerHTML"
>
    <a 
        href="/"
        hx-get="/"
        hx-target="#content_area"
        hx-push-url="true"
    >
        <div class="flex items-left">
            <div class="flex text-2xl lg:text-3xl">
                <i class='bx bx-layer pr-2' ></i>
                brood</span>
            </div>
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
            @click="show_search_box = !show_search_box" 
            @click.away="show_search_box = false"
        >
            <i class='bx bx-search' ></i>

            <div 
                class="
                    absolute 
                    right-2 mt-1 w-96 p-2
                    divide-y divide-zinc-200 dark:divide-zinc-800
                    rounded-md 
                    border border-zinc-200 dark:border-black
                    bg-white dark:bg-zinc-700
                    shadow-lg
                    z-50
                "
                x-cloak
                x-show="show_search_box" 
                x-transition
            >
                <input type="text" class="bg-black rounded-md"></input>
            </div>
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
            @click="
                show_main_bar = !show_main_bar;
                if (is_mobile) {
                    show_user_bar = false;
                }
            "
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
                text-xl
                cursor-pointer
            "
            
            @click="
                show_user_bar = !show_user_bar;
                if (is_mobile) {
                    show_main_bar = false;
                }
            "
        >
            <i class="bx bxs-user z-10 absolute text-zinc-400 -translate-x-1"></i> 
            <i class="bx bxs-user z-20 absolute text-black"></i> 
            <i class="bx bxs-user z-20 absolute translate-x-1"></i>
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
                    border border-zinc-200 dark:border-black
                    bg-white dark:bg-zinc-800
                    text-md text-zinc-800 dark:text-zinc-200
                    shadow-lg
                    z-[100]
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
                            rounded-md p-2
                            transition
                            hover:text-black hover:dark:text-white
                            hover:bg-zinc-400 hover:dark:bg-zinc-700/50
                        "
                    >
                        <i class='bx bxs-user'></i> Profile
                    </a>
                    <a 
                        href="#" 
                        class="
                            rounded-md p-2
                            transition
                            hover:text-black hover:dark:text-white
                            hover:bg-zinc-400 hover:dark:bg-zinc-700/50
                        "
                    >
                        <i class='bx bxs-cog' ></i> Settings
                    </a>
                </div>

                <div class="flex flex-col">
                    <a 
                        hx-get="/logout"
                        hx-swap="none" 
                        class="
                            rounded-md p-2
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
            <div 
                class="
                    inline-flex overflow-hidden 
                    justify-center items-center 
                    cursor-pointer
                "
                
                @click="$dispatch('toggle-login-modal')"
            >
                <i class='bx bx-log-in-circle text-3xl' ></i>
            </div>
        </div>
    <?php endif ?>
</div>

<?php $modal('login', $login_modal); ?>
