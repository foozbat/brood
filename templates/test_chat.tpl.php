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
        "
        x-data="{ 
            show_description_block: true, 
            show_jump_latest_icon: false,
            enable_old_messages_getter: false
        }"
    >
        <!-- header block -->
        <div class="
            flex
            text-zinc-950 dark:text-zinc-300
            pb-2
        ">
            <div class="text-lg lg:text-xl font-bold">
                <i class="bx bx-hash"></i>
                <?= $title ?>
            </div>

            <div class="flex flex-grow justify-end space-x-4 pr-2">
                <a 
                    href="#"
                    class="
                        text-xl
                        hover:text-black hover:dark:text-white
                    "
                    @click="
                        scroll_bottom = show_jump_latest_icon == false;
                        show_description_block = !show_description_block;
                        //if (scroll_bottom) {
                            console.log('resetting scrolltop');
                            $refs.chat_container.scrollTop = $refs.msg_anchor_newest.offsetTop;
                        //}
                    "

                >
                    <i class="bx bx-info-circle"></i>
                </a>

                <a 
                    href="#"
                    class="
                        text-xl
                        hover:text-black hover:dark:text-white
                    "
                    @click="
                        scroll_bottom = show_jump_latest_icon == false;
                        show_description_block = !show_description_block;
                        //if (scroll_bottom) {
                            console.log('resetting scrolltop');
                            $refs.chat_container.scrollTop = $refs.msg_anchor_newest.offsetTop;
                        //}
                    "

                >
                    <i class="bx bxs-bell"></i>
                </a>
            </div>
        </div>

        <!-- description block -->
        <div 
            class="
                text-zinc-950 dark:text-zinc-300
                pb-2
            "
            x-show="show_description_block"
            x-transition
        >
            <div class="
                    p-3
                    text-sm
                    bg-zinc-100 dark:bg-zinc-950 
                    text-zinc-950 dark:text-zinc-300
                    rounded-md
                    border-l-4 border-zinc-400 dark:border-zinc-600
            ">
                <?php breadcrumb() ?>
                                    
                <?= $description ?>

            </div>
        </div>

        <!-- main chat block -->
        <div
            class="
                relative
                w-full h-full
                bg-white dark:bg-zinc-800 
                text-zinc-950 dark:text-zinc-300
                rounded-md
                overflow-x-hidden
                border-r-2 border-b-2 border-zinc-300 dark:border-black
                p-3 pr-0
                mb-2
            "
        >
            <div 
                class="
                    w-full h-full 
                    overflow-y-auto
                    pr-3
                "
                x-ref="chat_container"
                x-init="$el.scrollTop = $refs.msg_anchor_newest.offsetTop"
                hx-ext="sse" 
                sse-connect="/test_sse"
            >
                <!-- scroll up old message getter -->
                <div
                    x-show="enable_old_messages_getter"
                    hx-get="/test_chat/messages"
                    hx-trigger="intersect"
                    hx-target="#old_chat_messages"
                    hx-swap="afterbegin"
                >old message getter</div>

                <!-- old chat messages -->
                <div
                    id="old_chat_messages"
                    x-ref="old_chat_messages"
                    class="space-y-3"
                >
                </div>

                <!-- current chat messages -->
                <div 
                    id="chat_messages"
                    class="space-y-3"
                    hx-get="/test_chat/messages"
                    hx-trigger="load"
                    x-on:htmx:after-swap="
                        $refs.msg_anchor_newest.scrollIntoView()
                        enable_old_messages_getter = true
                    "
                ></div>
                
                <!-- new chat messages -->
                <div 
                    id="new_chat_messages"
                    class="space-y-3"
                    x-ref="new_chat_messages"
                    hx-get="test_chat/messages/1"
                    hx-trigger="sse:chat-message"
                    hx-swap="beforeend"
                    x-on:sse:chat-message=""
                    x-on:htmx:after-swap="
                        if (!show_jump_latest_icon) {
                            $refs.msg_anchor_newest.scrollIntoView();
                        }
                    "
                ></div>

                <div 
                    x-ref="msg_anchor_newest" 
                    x-intersect:enter="show_jump_latest_icon = false"
                    x-intersect:leave="show_jump_latest_icon = true"
                >msg_anchor_newest</div>
            </div>

            <!-- top fade out -->
            <div 
                class="
                    absolute
                    fixed
                    w-full h-8
                    bg-gradient-to-b from-white dark:from-zinc-800 to-transparent
                    top-2
                "
                x-cloak
                x-transition
            >
            </div>

            <!-- bottom fade out -->
            <div 
                class="
                    absolute
                    fixed
                    w-full h-8
                    bg-gradient-to-t from-white dark:from-zinc-800 to-transparent
                    bottom-2
                "
                x-show="show_jump_latest_icon"
                x-cloak
                x-transition
            >
            </div>

            <!-- jump newest button -->
            <a 
                class="
                    absolute
                    bottom-4 right-4
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
                <span class="text-sm">Jump to Latest</span>
            </a>
        </div>

        <!-- new message block -->
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
                    bg-white dark:bg-zinc-950
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