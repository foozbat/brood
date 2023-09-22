<?php
/**
 * Main Forum Landing Template
 */

require_once "components/user_icon.tpl.php";
require_once "components/breadcrumb.tpl.php";

Fzb\extend("layouts/app_main.tpl.php");

function forum_thread(array $thread) { 
    // test
    $bold = rand(0,1);
    
    ?>
    <div class="
        flex
        space-x-3 
        bg-white dark:bg-zinc-800 
        items-center
        text-zinc-950 dark:text-zinc-300
        rounded-md
        border-r-2 border-b-2 border-zinc-300 dark:border-black
        p-2 mb-2
    ">
        <!-- user icon -->
        <div class="">
            <?php user_icon(size: 36) ?>
        </div>
        <!-- Thread title and poster -->
        <div class="w-full">
            <p>
                <a 
                    class="text-blue-500 hover:text-blue-400 hover:underline <?php if ($bold): ?>font-bold<?php endif ?>"
                    href="/test_thread"
                    hx-get="/test_thread"
                    hx-target="#content_area"
                    hx-push-url="true"
                >
                    <?= $thread['title'] ?>
                </a>
            </p>
            <span class="text-sm"><?= $thread['poster'] ?></span>
        </div>
        <!-- replies and views -->
        <div class="flex flex-wrap xl:flex-nowrap">
            <div class="
                flex flex-nowrap 
                items-center
                xl:pr-6
                text-zinc-600 dark:text-zinc-400
            ">
                <i class='bx bxs-message text-xl pr-2' ></i> <span class="text-sm">123</span>
            </div>
            <div class="
                flex flex-nowrap
                items-center
                xl:pr-6
                text-zinc-600 dark:text-zinc-400
            ">
            <i class='bx bx-show text-xl pr-2' ></i> <span class="text-sm">4.1K</span>
            </div>

        </div>
        <div class="
            flex flex-wrap
            whitespace-nowrap 
            items-center
            text-zinc-600 dark:text-zinc-400
            text-sm
        ">
            Jul 4, 2023<br />
            by SomeUser
        </div>
    </div><?php
};

$content = function () use ($title, $threads, $forum_description) { ?>
    <div 
        id="forum_list"
        class="w-full p-2"
    >
        <!-- Forum Header Bar -->
        <div class="flex flex-col">
            <div class="flex">
                <div class="flex-grow">
                    <p class="text-2xl lg:text-2xl pb-2">
                        <i class="bx bx-conversation"></i>
                        <?= $title ?>
                    </p>
                </div>
                <div class="items-left whitespace-nowrap">
                    <button class="
                        bg-blue-800 hover:bg-blue-700 
                        text-sm text-white font-bold 
                        py-2 px-4 rounded-full
                    ">
                        <i class='bx bxs-pencil' ></i>
                        New Thread
                    </button>
                </div>
            </div>

            <!-- description block -->
            <div 
                class="
                    bg-white dark:bg-zinc-800 
                    text-zinc-950 dark:text-zinc-300
                    border-r-2 border-zinc-300 dark:border-black
                    px-2
                "

            >
                <div class="
                        p-2 
                        text-sm
                        bg-zinc-100 dark:bg-zinc-950 
                        text-zinc-950 dark:text-zinc-300
                        rounded-md
                        border-l-4 border-zinc-400 dark:border-zinc-600
                ">
                    <?php breadcrumb() ?>
                                        
                    <?= $forum_description ?>

                </div>
            </div>


            <!-- Thread List -->
            <div id="threads">
                <?php foreach ($threads as $thread): ?>
                    <?php forum_thread($thread) ?>
                <?php endforeach ?>
            </div>
        </div>
    </div><?php
};