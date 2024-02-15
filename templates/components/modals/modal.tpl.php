<?php

$modal = function ($name, $content) { ?>
<div
    class="
        fixed inset-0 z-50 overflow-auto
        backdrop-blur
    "
    x-data="<?= $name ?>_modal"
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

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('<?= $name ?>_modal', () => ({
            open: false,
            toggle() {
                this.open = !this.open;
            },
        }));
    });
</script>

<?php } ?>