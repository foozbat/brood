<?php 
/**
 * Page Header Component
 */

require_once("components/user_icon.tpl.php");

$top_bar = function () { 
    $top_bar_height = "32";

    ?>
    <div class="
        flex fixed 
        w-full h-<?= $top_bar_height ?>
        items-center justify-between p-2
        border-b-2 border-zinc-200 dark:border-zinc-700
        text-zinc-100 bg-black
        z-20
        space-x-2
    ">
        <a 
            href="/"
            hx-get="/"
            hx-target="#content_area"
            hx-push-url="true"
        >
            <div class="flex items-left">
                <div class="flex text-lg lg:text-3xl">
                    <i class='bx bx-layer pr-2' ></i>
                    megaboard.<span class="text-red-700">chat</span>
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
        <div class="flex">
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
                <i class='bx bx-list-ul' ></i>
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
        <div x-data="{ show_profile_menu: false }">
            <button 
                type="button" 
                @click="show_profile_menu = !show_profile_menu" 
                @click.outside="show_profile_menu = false"
                class=""
            >
                <?php user_icon(size: 40) ?>
            </button>

            <!-- profile dropdown -->
            <div 
                class="
                    absolute 
                    right-2 mt-1 w-48
                    divide-y divide-zinc-200 dark:divide-zinc-800
                    rounded-md 
                    border border-zinc-200 dark:border-black
                    bg-white dark:bg-zinc-700
                    shadow-lg
                    z-50
                "
                x-cloak
                x-show="show_profile_menu" 
                x-transition
            >
                <div class="flex items-center space-x-2 p-2 text-sm font-bold">
                    Username
                </div>

                <div class="flex flex-col space-y-3 p-2">
                    <a href="#" class="transition hover:text-red-600"><i class='bx bxs-user'></i> Profile</a>
                    <a href="#" class="transition hover:text-red-600"><i class='bx bxs-cog' ></i> Settings</a>
                </div>

                <div class="flex flex-col space-y-3 p-2">
                    <a href="#" class="transition hover:text-red-600"><i class='bx bx-log-out' ></i> Log Out</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>