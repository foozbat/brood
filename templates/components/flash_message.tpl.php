<?php function flash_message() { ?>
    <div
        class="
            flex
            w-half
            p-2 mb-2
            text-md
            bg-green-100 dark:bg-green-900 
            text-zinc-900 dark:text-zinc-300 font-bold
            rounded-md
            border-l-4 border-green-400 dark:border-green-600
        "
        x-data="{ show: false, message: '' }"
        x-show="show"
        
        x-on:flash-message.document="show = true; message=$event.detail.value; setTimeout(() => show = false, 3000);"
        x-transition.enter.duration.100ms
        x-transition.leave.duration.300ms
        x-cloak
    >
        <div class="flex-grow" x-text="message"></div>
        <div class="text-xl cursor-pointer" @click="show = !show"><i class="bx bx-x"></i></div>
        
    </div>

<?php } ?>