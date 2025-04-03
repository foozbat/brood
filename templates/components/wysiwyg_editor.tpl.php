<?php function wysiwyg_editor($placeholder="", $slim=false, $form_name=null) { ?>
    <div 
        x-data="{ slim: <?= json_encode($slim) ?> }"
        class="
            w-full flex 

        "
        :class="{
            'flex-row items-center space-x-2': slim,
            'flex-col': !slim
        }"
    >
        <a 
            href="#"
            class="bx bx-dots-vertical-rounded text-xl"
        ></a>


        <textarea


            id="<?= $form_name ?>_editor"
            x-ref="<?= $form_name ?>_editor"
            name="content"
            class="
                grow
                <?php if ($slim): ?>
                    h-6
                <?php else: ?>
                    h-24
                <?php endif; ?>
                text-sm
                bg-transparent
                without-ring resize-none
                scrollbar-thin
            "

            <?php if (!$slim): ?>
                :class="{ 'h-48': !$store.ui.is_mobile }"
            <?php endif; ?>

            @input="
                max_height = $store.ui.is_mobile ? 100 : 200;
                $el.style.height = ($el.scrollHeight < max_height ? $el.scrollHeight : max_height) + 'px';
            "
            placeholder="<?= $placeholder ?>"

            <?php if ($slim): ?>
                @keydown.enter="
                    if ($event.shiftKey) {
                        console.log('shift+enter');
                        $el.classList.remove('h-6');
                        $el.classList.add('h-24');
                    } else {
                        console.log('enter');
                        $event.preventDefault();
                        $el.classList.remove('h-24');
                        $el.classList.add('h-6');                        
                        $refs.<?= $form_name ?>_send_message.click();
                    }
                "
            <?php endif; ?>
        ></textarea>

        <?php if ($slim): ?>
            <a 
                href="#"
                class="bx bxs-smile text-2xl"
            ></a>
            <a
                href="#"
                class="bx bxs-camera text-2xl"
            ></a>
            <a
                href="#"
                class="bx bx-paperclip text-2xl pr-2"
            >
            </a>
            <button
                x-ref="<?= $form_name ?>_send_message"
                class="
                    bg-gradient-to-b from-blue-800 to-blue-900
                    hover:from-blue-700 hover:to-blue-800
                    text-sm text-white font-bold flex-nowrap whitespace-nowrap
                    rounded-full w-8 h-8
                "
                @click="
                    if ($refs.<?= $form_name ?>_editor.value == '')
                        $event.preventDefault();
                    else
                        $nextTick(() => { $refs.<?= $form_name ?>.reset() });
                "
            >
                <i class='bx bxs-send' ></i>
            </button>
        <?php else: ?>
            <hr class="h-px my-2 bg-zinc-500 border-0">

            <div class="flex flex-row items-center">
                <a 
                    href="#"
                    class="
                        p-1 rounded-md hover:bg-zinc-200 hover:dark:bg-zinc-800
                        bx bx-bold text-xl"
                ></a>
                <a 
                    href="#"
                    class="
                        p-1 rounded-md hover:bg-zinc-200 hover:dark:bg-zinc-800
                        bx bx-italic text-xl"
                ></a>
                <a 
                    href="#"
                    class="
                        p-1 rounded-md hover:bg-zinc-200 hover:dark:bg-zinc-800
                        bx bx-underline text-xl"
                ></a>        
                <a 
                    href="#"
                    class="
                        p-1 rounded-md hover:bg-zinc-200 hover:dark:bg-zinc-800
                        bx bx-strikethrough text-xl"
                ></a>       
                <a 
                    href="#"
                    class="
                        p-1 rounded-md hover:bg-zinc-200 hover:dark:bg-zinc-800
                        bx bx-font text-xl"
                ></a>  
                <a 
                    href="#"
                    class="
                        p-1 rounded-md hover:bg-zinc-200 hover:dark:bg-zinc-800
                        bx bx-font-color text-xl"
                ></a>   
                <a 
                    href="#"
                    class="
                        p-1 rounded-md hover:bg-zinc-200 hover:dark:bg-zinc-800
                        bx bx-font-size text-xl"
                ></a>

                <div class="grow"></div>

                <a 
                    href="#"
                    class="
                        p-1 rounded-md hover:bg-zinc-200 hover:dark:bg-zinc-800
                        bx bxs-smile text-2xl "
                ></a>
                <a
                    href="#"
                    class="
                        p-1 rounded-md hover:bg-zinc-200 hover:dark:bg-zinc-800
                        bx bxs-camera text-2xl p-1
                    "
                ></a>
                <a
                    href="#"
                    class="
                        p-1 rounded-md hover:bg-zinc-200 hover:dark:bg-zinc-800
                        bx bx-paperclip text-2xl mr-2
                    "
                >
                </a>

                <button
                    x-ref="<?= $form_name ?>_send_message"
                    class="
                        bg-gradient-to-b from-blue-800 to-blue-900
                        hover:from-blue-700 hover:to-blue-800
                        text-sm text-white font-bold whitespace-nowrap
                        py-1 px-2 rounded-full
                    "
                >
                    <i class='bx bxs-send' ></i>
                </button>
            </div>
        <?php endif; ?>
    </div>
<?php }