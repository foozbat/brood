<?php 

function item_link($label, string $type, $posts) { 
    $icons = [
        "pin" => "bx bxs-pin",
        "forum" => "bx bxs-conversation",
        "chat" => "bx bx-hash",
        "video" => "bx bxs-video"
    ];

    ?>
    <a 
        class="
            flex items-center space-x-1 rounded-md px-2 
            hover:text-black 
            hover:bg-blue-800/20 hover:dark:text-white
        "
        href="/test_forum"
        hx-get="/test_forum"
        hx-target="#content_area"
        hx-replace-url="true"
        hx-push-url="true"
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

?>

<div 
    id="main_bar"
    class="
        flex flex-col
        space-y-1 m-1 p-2 mb-2
        rounded-md border-r-2 border-b-2 
        border-zinc-300 dark:border-black
        bg-zinc-100 dark:bg-zinc-950
        text-zinc-800 dark:text-zinc-300
    "
>
    <div
        class="
            flex justify-center items-center 
            w-full 
            space-x-3 pb-1 pt-1 px-2
            rounded-md 
            text-zinc-600 dark:text-zinc-400
            hover:bg-zinc-200 hover:text-black 
            hover:dark:bg-zinc-900/50 hover:dark:text-white
            cursor-pointer
        "
        @click="show_main_bar = !show_main_bar"
    >
        <div 
            class="
                inline-flex overflow-hidden 
                justify-center items-center 
                w-[32px] h-[32px] 
                text-3xl
            "
        >
            <i class='bx bx-list-ul' ></i>
        </div>
        
        <span
            class="
                inline-block
                w-full
                align-middle
                uppercase font-bold text-sm 
            "
        >
            Groups
        </span>
        <span
            class="
                inline-block
                align-middle
                text-sm font-bold uppercase
            "
        >
            <i class='bx bx-chevrons-left text-2xl' ></i>
        </span>
    </div>

    <?php foreach ($forum_index as $section_name => $section_data): ?>
        <div 
            class="
                flex flex-col 
                space-y-1 m-1 pb-4
                
                border-zinc-300 dark:border-black
                bg-zinc-100 dark:bg-zinc-950
                text-zinc-800 dark:text-zinc-300
            "
        >
            <span class="text-lg pb-2">
                <i class="bx bx-collection"></i>
                <?= $section_name ?>
            </span>
            
            <?php foreach ($section_data as $section_item): ?>
                <?php item_link(...$section_item) ?>
            <?php endforeach ?>
        </div>
    <?php endforeach ?>