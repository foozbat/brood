<?php

function hx_modal($modal) { ?>
    hx-get="<?= $modal ?>"
    hx-target="#modal_container"
    hx-swap="innerHTML"
<?php
}

function modal_container() { ?>
    <div
        id="modal_container"
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
        @show-modal.document="show()"
        x-transition
        x-cloak
    >
        
    </div><?php 
}