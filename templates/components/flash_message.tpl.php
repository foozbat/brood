<?php function flash_message($name = '', $timeout=3000, $dismissable=true, $floating=false) { ?>
    <?php if ($floating): ?>
    <div class="
        absolute z-[100]
        w-full 
        flex justify-center
    ">
    <?php endif; ?>
    <div
        class="
            flex
            p-2 mb-2
            text-md
            text-zinc-900 dark:text-zinc-300 font-bold
            rounded-md
            border-l-4 border-green-400 dark:border-green-600
        "
        x-data="{ show: false, type: 'info', message: '' }"
        x-show="show"
        :class="{ 
            'bg-zinc-100 dark:bg-zinc-950 border-zinc-200 dark:border-zinc-600': type == 'info',
            'bg-green-100 dark:bg-green-950 border-green-400 dark:border-green-600': type == 'success',
            'bg-red-100 dark:bg-red-950 border-red-400 dark:border-red-600': type == 'failure',
        }"

        @flash-message<?php if ($name) echo "-".$name; ?>.document="
            show = true; 
            type = $event.detail.type; 
            message = $event.detail.message;
            <?php if ($timeout): ?>
                setTimeout(() => show = false, <?= $timeout ?>);
            <?php endif ?>
        "
        @flash-message<?php if ($name) echo "-".$name; ?>-hide.document="$nextTick(() => show = false)";

        x-transition.enter.duration.50ms
        x-transition.leave.duration.300ms
        x-cloak
    >
        <div class="flex-grow" x-text="message"></div>
        <?php if ($dismissable): ?>
            <div class="text-xl cursor-pointer" @click="show = false"><i class="bx bx-x"></i></div>
        <?php endif ?>        
    </div>

    <?php if ($floating): ?>
    </div>
    <?php endif; ?>

<?php } ?>