<?php 
/*
    Main Menu Bar Component
*/

require_once("components/user_icon.tpl.php");

function heading_link(string $label, string $type, $href='', $unread=0, $target="#content_area", $swap="innerHTML") {
    $icons = [
        "home"  => "bx bxs-home",
        "dm"    => "bx bxs-message-rounded",
        "group" => "bx bx-list-ul",
    ];

    ?>
    <div
        class="
            flex justify-center items-center 
            w-full 
            space-x-2 pb-2 pt-1 px-2
            rounded-md 
            text-zinc-600 dark:text-zinc-400
            hover:bg-zinc-200 hover:text-black 
            hover:dark:bg-zinc-900 hover:dark:text-white
            cursor-pointer
        "
        <?php if ($href): ?>
            hx-get="<?= $href ?>"
            hx-target="<?= $target ?>"
            hx-swap="<?= $swap ?>"
        <?php endif ?>
    >
        <div 
            class="
                inline-flex overflow-hidden 
                justify-center items-center 
                w-[32px] h-[32px] 
                text-2xl
            "
        >
            <i class='<?= $icons[$type] ?>' ></i>
        </div>
        <span
            class="
                inline-block
                w-full
                align-middle
                uppercase font-bold text-sm 
            "
        >
            <?= $label ?>
        </span>
        <?php if ($unread): ?>
            <span class="
                transform rounded-full
                px-1.5 py-0.5
                border-r-2 border-b-2 border-red-950
                text-xs font-bold leading-none 
                text-white bg-red-700
            ">
                <?= $unread ?>
            </span>
        <?php endif ?>
    </div><?php
}

function item_link(string $label, string $type, $posts) { 
    $icons = [
        "pin" => "bx bxs-pin",
        "forum" => "bx bxs-conversation",
        "chat" => "bx bx-hash",
        "video" => "bx bxs-video",
        "links" => "bx bx-link"
    ];

    ?>
    <a 
        class="
            flex items-center space-x-1 rounded-md px-2 
            hover:bg-zinc-200 hover:dark:bg-zinc-900 
            hover:text-black hover:dark:text-white
        "
        href="/test_forum"
        hx-get="/test_forum"
        hx-target="#content_area"
        hx-replace-url="true"
        hx-push-url="true"

        @click="(is_mobile ? show_main_bar=false: '')"
    >
        <span class="text-lg"><i class="<?= $icons[$type] ?>"></i></span>
        <span class="text-sm w-full"><?= $label ?></span>
        <?php if($posts > 0): ?>
            <?php if ($posts == "LIVE"): ?>
                <span class="
                    transform rounded-full
                    px-1 py-0.5
                    border-r-2 border-b-2 border-red-950
                    text-xs font-bold leading-none 
                    text-white bg-red-700
                ">
            <?php else: ?>
                <span class="text-xs font-bold">
            <?php endif ?>
                <?= $posts ?>
            </span>
        <?php endif ?>
    </a><?php
}

function dm_link($user) { ?>
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
        <div class="w-full">
            <div class="text-sm"><?= $user['username'] ?></div>
            <div class="text-xs text-zinc-500 w-full"><?= $status ?></div>
        </div>
        <div>
            <?php if ($user['unread']): ?>
                <span class="
                    transform rounded-full
                    px-1.5 py-0.5
                    border-r-2 border-b-2 border-red-950
                    text-xs font-bold leading-none 
                    text-white bg-red-700
                ">
                <?= $user['unread'] ?>
                </span>
            <?php endif ?>
        </div>
    </a><?php 
} 

?>

<div 
    id="main_bar"
    class="
        flex flex-col
        space-y-1 m-1 p-2 mb-2
        rounded-md border-r-2 border-b-2 
        border-zinc-300 dark:border-black
        shadow-lg
        bg-zinc-100 dark:bg-zinc-950
        text-zinc-800 dark:text-zinc-300
    "
>

    <!-- Private Messages -->
    <?php heading_link("Direct Messages", "dm", "/components/main_bar/dm", 5, "#main_bar", "outerHTML"); ?>
    
    <!-- Home -->
    <?php heading_link("Home", "home", "/") ?>


    <!-- Groups Index -->
    <?php if ($dm_users): ?>
        <?php foreach ($dm_users as $user): ?>
            <?php dm_link($user) ?>
        <?php endforeach ?>
    <?php else: ?>
        <?php foreach ($forum_index as $section_name => $section_data): ?>
            <?php heading_link($section_name, "group", 0); ?>

            <div 
                class="
                    flex flex-col 
                    space-y-1 m-1 pb-4
                    
                    border-zinc-300 dark:border-black
                    bg-zinc-100 dark:bg-zinc-950
                    text-zinc-800 dark:text-zinc-300
                "
            >
                <?php foreach ($section_data as $section_item): ?>
                    <?php item_link(...$section_item) ?>
                <?php endforeach ?>
            </div>
        <?php endforeach ?>
    <?php endif ?>