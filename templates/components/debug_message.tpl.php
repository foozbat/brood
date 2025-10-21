<?php function debug_message($name = '', $dismissable=true) { ?>
        <div class="
        absolute z-[100]
        w-full 
        flex justify-center
    ">
        <div
            class="
                flex
                p-2 mb-2
                text-md
                text-zinc-900 dark:text-zinc-300
                rounded-md
                

                bg-zinc-100/50 dark:bg-zinc-950/50 border-zinc-200 dark:border-zinc-600
            "
            x-data="{ show: false, message: '' }"
            x-show="show"

            @debug-message.document="
                show = true; 
                message = $event.detail.message;
            "
            x-transition.enter.duration.50ms
            x-transition.leave.duration.300ms
            x-cloak
        >
            <div class="flex-grow">
                <pre x-text="message"></pre>
            </div>
            <?php if ($dismissable): ?>
                <div class="text-xl cursor-pointer" @click="show = false"><i class="bx bx-x"></i></div>
            <?php endif ?>        
        </div>
    </div>
<?php } ?>