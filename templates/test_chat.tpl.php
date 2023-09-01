<?php
/**
 * Thread View Template
 */

require_once "components/breadcrumb.tpl.php";

Fzb\extend("layouts/app_main.tpl.php");

$content = function() use ($title, $description, $chats) { ?>
    <div
        id="chat_room"
        class="
            h-full p-2 flex flex-col
            relative
        "
    >
        <div class="flex space-x-2 text-xl lg:text-2xl">
            <i class="bx bx-hash"></i>
            <?= $title ?>
            <?php breadcrumb() ?>
        </div>
        
<!--
        <div class="
                p-4 mt-2 mb-4
                text-sm
                bg-zinc-100 dark:bg-zinc-950 
                text-zinc-950 dark:text-zinc-300
                rounded-md
                border-l-4 border-zinc-400 dark:border-zinc-600
            ">
                <?= $description ?>
        </div>
-->

        <div
            class="
                w-full h-full
                bg-white dark:bg-zinc-800 
                text-zinc-950 dark:text-zinc-300
                rounded-md
                overflow-y-auto
                border-r-2 border-b-2 border-zinc-300 dark:border-black
                p-3 
                mt-2 mb-2
            "
            x-ref="chat_container"
            x-data="{ show_jump_latest_icon: false }"
        >
            <div 
                id="chat_messages"
                class="space-y-3"
                hx-get="/test_chat/messages"
                hx-trigger="load"
            >
                <!-- chat messages here -->
            </div>

            <a 
                class="
                    absolute
                    bottom-24 right-10
                    rounded-full shadow-lg
                    bg-blue-800 hover:bg-blue-700 
                    text-white font-bold 
                    py-2 px-3 md:px-4
                    z-70
                "
                href="#"
                x-show="show_jump_latest_icon"
                x-transition
                @click="$refs.msg_anchor_newest.scrollIntoView({ behavior: 'smooth' })"
            >
                <i class="bx bx-chevron-down text-xl md:text-sm"></i>
                <span class="text-sm hidden md:contents">Jump to Latest</span>
            </a>

            <div 
                x-ref="msg_anchor_newest" 
                x-intersect:enter="show_jump_latest_icon = false"
                x-intersect:leave="show_jump_latest_icon = true"
            ></div>
        </div>

        <div class="
            w-full
            flex flex-nowrap
            items-center
            bg-white dark:bg-zinc-800 
            text-zinc-700 dark:text-zinc-400
            rounded-md 
            border-r-2 border-b-2 border-zinc-300 dark:border-black
            p-1 px-2 space-x-2
        ">
            <a 
                href="#"
                class="bx bxs-smile text-2xl"
            ></a>
            <input 
                type="text"
                class="
                    bg-zinc-100 dark:bg-zinc-900
                    rounded-md
                    border-0
                    w-full
                "
            />
            <a
                href="#"
                class="bx bxs-camera text-2xl"
            ></a>
            <a
                href="#"
                class="bx bx-paperclip text-2xl"
            >
                </a>
        </div>
   </div><?php
};