<?php function discussion_post($poster, $content) { ?>
    <div class="
        bg-white dark:bg-zinc-800 
        text-zinc-950 dark:text-zinc-300
        rounded-md
        border-r-2 border-b-2 border-zinc-300 dark:border-black
        p-4 mb-4
    ">
        <b><?= $poster ?></b>
        <p><?= $content ?></p>
    </div>
<?php } ?>