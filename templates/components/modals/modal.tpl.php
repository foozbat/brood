<?php

$modal = function ($name, $content) { ?>

<div
    class="
        fixed inset-0 z-50 overflow-auto
        backdrop-blur
        shadow-lg
    "
    x-data="modal"
    x-show="open"
    x-on:toggle-<?= $name ?>-modal.window="toggle"
    x-transition
    x-cloak
>
    <div class="
        flex
        justify-center
        items-center
        h-full
    ">
        <?php $content() ?>
    </div>
</div>

<?php } ?>