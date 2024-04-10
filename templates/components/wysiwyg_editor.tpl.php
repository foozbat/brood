<?php function wysiwyg_editor($placeholder="", $slim=false) { ?>

    <div class="
        w-full flex 
        <?php if ($slim): ?>
            flex-row
            items-center
            space-x-2
        <?php else: ?>
            flex-col
        <?php endif; ?>
    ">
        <a 
            href="#"
            class="bx bx-dots-vertical-rounded text-xl"
        ></a>

        <textarea
            id="editor"
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
            "

            <?php if (!$slim): ?>
                :class="{ 'h-48': !$store.ui.is_mobile }"
            <?php endif; ?>

            x-data="text_field"

            @focus="focus"
            @blur="blur"
            @input="
                max_height = $store.ui.is_mobile ? 100 : 200;
                $el.style.height = ($el.scrollHeight < max_height ? $el.scrollHeight : max_height) + 'px';
            "
            placeholder="<?= $placeholder ?>"

            <?php if ($slim): ?>
                @keydown.enter.shift="console.log('shift+enter');";
                @keydown.enter.prevent="console.log('enter');";
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
                class="
                    bg-gradient-to-b from-blue-800 to-blue-900
                    hover:from-blue-700 hover:to-blue-800
                    text-sm text-white font-bold flex-nowrap whitespace-nowrap
                    rounded-full w-8 h-8
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