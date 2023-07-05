<?php 

function item_link($label, string $type, $posts) { 
    $icons = [
        "pin" => "bx bxs-pin",
        "forum" => "bx bxs-conversation",
        "chat" => "bx bx-hash",
        "video" => "bx bxs-video"
    ];

    ?>
    <a href="#" class="
        flex items-center space-x-1 rounded-md px-2 
        hover:bg-zinc-300 hover:text-red-800 
        hover:dark:bg-zinc-900 hover:text-white
    ">
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

foreach ($forum_index as $section_name => $section_data) { ?>
    <div class="
        flex flex-col 
        space-y-1 p-2 mb-2
        rounded-md border-r-2 border-b-2 
        border-zinc-300 dark:border-black
        bg-zinc-200 dark:bg-zinc-950
        text-zinc-800 dark:text-zinc-300
    ">
        <span class="text-lg pb-2">
            <i class="bx bxs-chevron-down"></i>
            <?= $section_name ?>
        </span>
        
        <?php foreach ($section_data as $section_item): ?>
            <?php item_link(...$section_item) ?>
        <?php endforeach ?>
    </div><?php    
}

?>