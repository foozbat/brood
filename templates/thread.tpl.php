<?php
/**
 * Thread View Template
 */

require_once "components/flash_message.tpl.php";
require_once 'components/user_icon.tpl.php';
require_once 'components/breadcrumb.tpl.php';
require_once 'components/pagination.tpl.php';
require_once 'components/wysiwyg_editor.tpl.php';
require_once 'utils/bbcode.php';

Fzb\extend('layouts/app_main.tpl.php');

function post_action_button(string $type) { 
    
    $button_info = [
        'reply' => [
            'title' => 'Reply',
            'icon' => 'bx-pencil text-amber-800 dark:text-amber-500'
        ],
        'quote' => [
            'title' => 'Quote',
            'icon' => 'bxs-quote-alt-left text-green-600'
        ],
        'like' => [
            'title' => 'Like',
            'icon' => 'bxs-like text-blue-600'
        ],
        'report' => [
            'title' => 'Report',
            'icon' => 'bxs-error-circle text-red-600'
        ], 
    ];
    ?>
    <a 
        href="#"
        class="
            py-1 px-3 mr-1
            rounded-full
            bg-zinc-200 dark:bg-zinc-900
            text-sm
            hover:bg-zinc-300 hover:text-black 
            hover:dark:bg-zinc-700 hover:dark:text-white
        "
    >
        <i class="bx <?= $button_info[$type]['icon'] ?>"></i>
        <?= $button_info[$type]['title'] ?>
    </a>
    <?php
}

function thread_post($message) { ?>
    <div class="
        flex flex-wrap lg:flex-nowrap w-full
        bg-white dark:bg-zinc-800 
        text-zinc-950 dark:text-zinc-300
        rounded-md
        border-t border-l border-r-2 border-b-2 border-zinc-300 dark:border-black dark:border-t-zinc-900 dark:border-l-zinc-900
        p-3
    ">
        <div class="w-full lg:w-48 h-min flex flex-nowrap lg:flex-wrap pb-4 lg:border-0 border-zinc-500">
            <div>
                <?php user_icon(size: 64) ?>
            </div>
            <div class="pl-4 lg:pl-0">
                <p>
                    <a 
                        href="#"
                        class="text-blue-500 hover:text-blue-400 hover:underline font-bold"
                    >
                        <?= $message->user->username ?>
                    </a>
                </p>
                <p class="text-sm">
                    Title
                </p>
                <p class="text-sm lg:pl-0 text-zinc-500 dark:text-zinc-400">
                    Joined Jan 1, 2023
                </p>
            </div>
            <div class="pl-8 lg:pl-0 lg:pt-2">
                <p class="text-sm pt-2 text-zinc-500 dark:text-zinc-400">
                    <i class="bx bxs-message"></i> 1234<br />
                    <i class="bx bx-hash"></i> 234.5K
                </p>
                
            </div>
        </div>
        
        <div class="w-full">
            <div class="flex">
                
                <span class="
                    text-sm 
                    w-full
                    text-zinc-800 dark:text-zinc-400
                ">
                    Jan 1, 2023
                </span>
                <span class="
                    text-sm
                    text-zinc-800 dark:text-zinc-400
                ">
                    #32
                </span>
            </div>

            <div class="pt-2 pb-4">
                <?php
                    echo str_replace("\n", "<br />", bbcode($message->content));    
                ?>
            </div>
            <div class="text-right">
                <?php post_action_button('reply') ?>
                <?php post_action_button('quote') ?>
                <?php post_action_button('like') ?>
                <?php post_action_button('report') ?>
            </div>
        </div>
    </div><?php
}

$title = $thread->title;
$content = function() use ($thread, $messages, $auth) { ?>
    <div 
        class="p-2 h-full flex flex-col rounded-md"
        hx-get="/test_thread/"
        hx-target="#content_area"
        hx-trigger="user-login-success from:body, user-logout from:body"
    >
        <div
            class="
                w-full h-full
                flex flex-col
                overflow-y-auto
                space-y-2
                
            "
        >
            <?php if (!$thread): ?>
                Thread not found.
            <?php else: ?>
            <!-- header block -->
            <div 
                x-show="!$store.ui.mobile_keyboard_active"
                class="
                    flex
                    text-zinc-950 dark:text-zinc-300
                    pb-1
                "
            >
                <h1 class="text-lg lg:text-xl">
                    <!--<i class="bx bx-chat"></i>-->
                    <?= $thread->title ?>
                </h1>

                <div class="flex flex-grow justify-end items-end space-x-4 pr-2">
                    <button 
                        class="
                            text-xl
                            hover:text-black hover:dark:text-white
                        "
                        @click="
                            show_description_block = !show_description_block;
                            if (!show_jump_latest_icon) {
                                console.log('resetting scrolltop');
                            $nextTick(() => { 
                                $refs.chat_container.scrollTop = $refs.msg_anchor_newest.offsetTop; });
                            }
                        "

                    >
                        <i class="bx bx-info-circle"></i>
                    </button>

                    <button 
                        class="
                            text-xl
                            hover:text-black hover:dark:text-white
                        "
                    >
                        <i class="bx bxs-bell"></i>
                    </button>
                </div>
            </div>



            <!-- messages -->

                <?php foreach ($thread->messages as $message): ?>
                    <?php thread_post($message) ?>
                <?php endforeach ?>
            </div>

            <!-- pagination/reply block -->
            <div 
                class="
                    w-full
                    bg-zinc-100 dark:bg-zinc-950 
                            text-zinc-950 dark:text-zinc-300
                            rounded-md
                            border border-zinc-200 dark:border-black
                    mt-2
                "
                x-data="editor"
            >
                <div 
                    class="flex items-start p-2"
                    x-show="open"

                >
                    <?php wysiwyg_editor(placeholder: "Reply") ?>
                    
                    <button 
                        class="text-2xl"
                        @click="hide()"
                    >
                        <i class="bx bx-x"></i>
                    </button>

                </div>

                <div 
                    class="
                        flex w-full
                        p-1 px-2 space-x-2
                        items-center text-xs
                    "
                    x-show="!(open && $store.ui.is_mobile)"
                >
                        
                    <span>1-20 of 129084 posts</span>

                    <nav 
                        class="
                            flex-grow justify-center align-center 
                            text-sm isolate inline-flex -space-x-px rounded-md shadow-sm
                        " 
                        aria-label="Pagination"
                        
                        x-show="!(open && $store.ui.is_mobile)"
                    >

                        <a href="#" class="relative inline-flex items-center rounded-md px-2 py-2 hover:bg-zinc-200 dark:hover:bg-zinc-700 focus:outline-offset-0">
                            <i class="bx bx-chevron-left"></i>
                        </a>

                        <!--<a href="#" aria-current="page" class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">1</a>-->
                        <a href="#" class="relative inline-flex items-center px-3 py-1 rounded-md  hover:bg-zinc-200 dark:hover:bg-zinc-700 focus:outline-offset-0">
                            1
                        </a>
                        <a href="#" class="relative inline-flex whitespace-nowrap items-center px-3 py-1 rounded-md  bg-zinc-200 dark:bg-zinc-700 focus:outline-offset-0">
                            2 of 500
                        </a>
                        <a href="#" class="relative inline-flex items-center px-3 py-1 rounded-md  hover:bg-zinc-200 dark:hover:bg-zinc-700 focus:outline-offset-0">
                            500
                        </a>

                        <a href="#" class="relative inline-flex items-center rounded-md px-2 py-2 hover:bg-zinc-200 dark:hover:bg-zinc-700 focus:outline-offset-0">
                            <i class="bx bx-chevron-right"></i>
                        </a>
                    </nav>

                    <button 
                        class="
                            bg-gradient-to-b from-blue-800 to-blue-900 
                            hover:from-blue-700 hover:to-blue-800
                            text-sm text-white font-bold whitespace-nowrap
                            py-1 px-4 rounded-full
                            w-24
                        "
                        x-show="!open"

                        <?php if ($auth->is_authenticated): ?>
                            @click="show()"
                        <?php else: ?>
                            @click="$dispatch('show-login-modal')"
                        <?php endif; ?>
                    >
                        <i class='bx bxs-pencil' ></i>
                        Reply
                    </button>

    

                    <div class="w-24" x-show="open"></div>

                </div>

            <?php endif; ?>
        </div>
    </div><?php
};