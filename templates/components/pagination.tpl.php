<?php function pagination_bar() { ?>
    <div class="
        w-full
        flex flex-nowrap
        items-center
        bg-white dark:bg-zinc-800 
        text-zinc-700 dark:text-zinc-400
        rounded-md 
        border-r-2 border-b-2 border-zinc-300 dark:border-black
        p-1 px-2 space-x-2
    ">
        <div class="flex-grow align-center text-sm">
            Page 1 of 7
        </div>

        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
            <a href="#" class="relative inline-flex items-center rounded-md px-2 py-2 hover:bg-zinc-200 dark:hover:bg-zinc-700 focus:z-20 focus:outline-offset-0">
                <i class="bx bxs-left-arrow"></i>
            </a>

            <!--<a href="#" aria-current="page" class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">1</a>-->
            <?php for ($i=0; $i<5; $i++): ?>
                <a href="#" class="relative inline-flex items-center px-3 py-1 text-sm font-semibold rounded-md  hover:bg-zinc-200 dark:hover:bg-zinc-700 focus:z-20 focus:outline-offset-0">
                    <?= $i+1 ?>
                </a>
            <?php endfor; ?>

            <a href="#" class="relative inline-flex items-center rounded-md px-2 py-2 hover:bg-zinc-200 dark:hover:bg-zinc-700 focus:z-20 focus:outline-offset-0">
                <i class="bx bxs-right-arrow"></i>
            </a>
        </nav>

        <div class="flex flex-grow align-center justify-end text-sm ">
            Next <i class="bx bx-right-arrow-alt text-xl"></i>
        </div>
    </div>
<?php } ?>