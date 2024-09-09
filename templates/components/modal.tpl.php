<div
    id="<?= $name ?>_modal"
    class="
        w-full h-full
        fixed flex
        justify-center
        items-center
        inset-0 z-50 overflow-auto
        backdrop-blur-sm
        bg-black/25 dark:bg-zinc-900/25
    "
    x-data="modal"
    x-show="open"
    @show-<?= $name ?>-modal.document="show()"
    x-transition
    x-cloak
>
    <?php $content() ?>
</div>