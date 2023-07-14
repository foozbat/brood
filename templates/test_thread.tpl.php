<?php
/**
 * Thread View Template
 */

require_once "components/user_icon.tpl.php";
require_once "utils/bbcode.php";

Fzb\extend("layouts/app_main.tpl.php");

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

function thread_post($post) { ?>
    <div class="
        flex flex-wrap lg:flex-nowrap w-full
        bg-white dark:bg-zinc-800 
        text-zinc-950 dark:text-zinc-300
        rounded-md
        border-r-2 border-b-2 border-zinc-300 dark:border-black
        p-3 mb-2
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
                        <?= $post['poster'] ?>
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
                    $content = (string) $post['content'];
                    $content = bbcode($content);
                    $content = str_replace("\n", "<br />", $content);
                    echo $content;    
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

$content = function() use ($title, $posts) { ?>
    <div 
        id="forum_list"
        class="w-full p-2"
    >
        <div class="flex flex-col pb-4">
            <div class="flex">
                <div class="flex-grow">
                    <p class="text-2xl lg:text-3xl pb-2">
                        <?= $title ?>
                    </p>
                </div>
                <div class="items-left whitespace-nowrap">
                    <button class="
                        bg-blue-800 hover:bg-blue-700 
                        text-sm text-white font-bold 
                        py-2 px-4 rounded-full
                    ">
                        <i class='bx bx-plus' ></i>
                        Follow
                    </button>
                </div>
            </div>
            <div class="flex">
                <button 
                    class="
                        py-1 px-4 mr-1
                        rounded-full
                        bg-zinc-100 dark:bg-zinc-950
                        text-sm
                        hover:bg-zinc-300 hover:text-black 
                        hover:dark:bg-zinc-700 hover:dark:text-white
                    "
                >
                    <i class="bx bx-home"></i>
                    Home
                </button>
                <button 
                    class="
                        py-1 px-4 mr-1
                        rounded-full
                        bg-zinc-100 dark:bg-zinc-950
                        text-sm
                        hover:bg-zinc-300 hover:text-black 
                        hover:dark:bg-zinc-700 hover:dark:text-white
                    "
                >
                    <i class="bx bx-collection"></i>
                    General Discussion
                </button>
                <button 
                    href="#"
                    class="
                        py-1 px-4 mr-1
                        rounded-full
                        bg-zinc-100 dark:bg-zinc-950
                        text-sm
                        hover:bg-zinc-300 hover:text-black 
                        hover:dark:bg-zinc-700 hover:dark:text-white
                    "
                >
                    <i class="bx bxs-conversation"></i>
                    Programming
                </button>
            </div>
        </div>

        <div class="flex flex-col">
            <div id="threads">
                <?php foreach ($posts as $post): ?>
                    <?php thread_post($post) ?>
                <?php endforeach ?>
            </div>
        </div>
    </div><?php
};