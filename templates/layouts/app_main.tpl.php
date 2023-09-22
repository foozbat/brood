<?php 
/**
 * Main Page Layout Template (extendable)
 */

require "components/top_bar.tpl.php"; 
require "components/page_footer.tpl.php"; 

?>
<?php if ($_SERVER['HTTP_HX_REQUEST']): ?>
    <title>brood: <?= $title ?></title>
    <?php $content() ?>
<?php else: ?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>brood: <?= $title ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!--<link rel="manifest" href="site.webmanifest">-->
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/static/app.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/htmx.org@1.9.4"></script>
    <script src="https://unpkg.com/htmx.org/dist/ext/sse.js"></script>
    <script src="https://unpkg.com/alpinejs-swipe@1.0.2/dist/cjs.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <style>
        [x-cloak] { display: none !important; }
    </style>

    <script>
        // move all this into a .js file

        document.addEventListener('alpine:init', () => {
            console.log('Alpine Init');
            
            Alpine.store('htmx', {
                is_swapping: false,
                is_snapshotting: false,

                async swap_complete() {
                    await new Promise(r => setTimeout(r, 50));
//                    return await this.is_swapping == false;

                },
                async snapshot_complete() {
                    /*
                    if (this.is_snapshotting == false) {
                        console.log("waiting for snapshot to start");
                        await new Promise(r => setTimeout(r, 50));
                        console.log("wait complete");
                    }
                    while (this.is_snapshotting) {
                        console.log("we're snapshotting, now wait for complete");
                    }
                    console.log("snapshot complete!");
*/
                },
            });

            Alpine.data('dropdown', () => ({
                open: false,

                toggle() {
                    this.open = !this.open;
                },
                async click_away() {
                    if (this.open) {
                        // waiting for htmx history snapshot");
                        await new Promise(r => setTimeout(r, 50));
                        console.log("done");
                        this.open = false;
                    }
                }
            }));
        });

        document.addEventListener('htmx:beforeHistorySave', () => {
            //console.log('evt: htmx is snapshotting');
            //Alpine.store('htmx').is_snapshotting = true;
        });

        document.addEventListener('htmx:pushedIntoHistory', async () => {
            //console.log('evt: htmx is done snapshotting');
            //Alpine.store('htmx').is_snapshotting = false;
        });

    </script>

</head>

<!-- page -->
<body 
    class="
        min-h-screen w-full 
        bg-zinc-200 dark:bg-zinc-900 
        text-zinc-700 dark:text-zinc-300
    "
    x-data="{ 
        is_mobile: !window.matchMedia('(min-width: 1024px)').matches,
        show_main_bar: window.matchMedia('(min-width: 1024px)').matches,
        show_user_bar: window.matchMedia('(min-width: 1024px)').matches,
        active_main_bar_menu: 'groups',
    }"
>
    <!-- header page -->
    <?php $top_bar() ?>

    <!-- main sidebar -->
    <nav
        id="main_bar"
        x-ref="main_bar"

        class="
            h-[calc(100%-4rem)]
            top-16
            fixed
            overflow-y-auto
            z-20
            w-72 lg:w-64 xl:w-72
            scrollbar-thin
        "

        x-show="show_main_bar"
        x-swipe:left="show_main_bar = false"

        @click.away="
            if (show_main_bar && is_mobile) {
                await $store.htmx.snapshot_complete();
                show_main_bar = false;
            }
        "

        x-transition.delay.1000ms:enter="transition duration-250"
        x-transition.delay.1000ms:enter-start="transform -translate-x-full opacity-0 scale-90"
        x-transition.delay.1000ms.:enter-end="transform translate-x-0 opacity-100 scale-100"
        x-transition.delay.1000ms:leave="transition duration-250"
        x-transition.delay.1000ms:leave-start="transform opacity-100 scale-100"
        x-transition.delay.1000ms:leave-end="transform -translate-x-full opacity-0 scale-90"

        hx-get="/components/main_bar"
        hx-trigger="load"
    >
    </nav>
    
    <!-- main content area -->
    <main 
        id="content_area"
        x-ref="content_area"

        class="
            h-[calc(100%-4rem)]
            fixed
            left-0 right-0 top-16
            overflow-y-auto
            z-10
            flex flex-col
        "
        :class="{ 
            'lg:left-64 xl:left-72': show_main_bar,
            'pl-0 lg:pl-16 xl:pl-32': !show_main_bar,

            'lg:right-48 xl:right-64': show_user_bar,
            'pr-0 lg:pr-16 xl:pr-32': !show_user_bar,
        }"

        x-swipe:right.threshold.100px="
            if (!show_main_bar && !show_user_bar) {
                show_main_bar = true;
            }
        "
        x-swipe:left.threshold.100px="
            if (!show_user_bar && !show_main_bar) {
                show_user_bar = true;
            }
        "
        x-on:htmx:after-swap="$el.scrollTop=0;"
    >
        <?php $content() ?>
    </main>

    <!-- user sidebar -->
    <aside
        id="user_bar"
        x-ref="user_bar"

        class="
            h-[calc(100%-4rem)]
            top-16 pb-2
            right-0 fixed
            overflow-y-auto 
            z-10
            w-64 lg:w-48 xl:w-64
            scrollbar-thin
        "

        x-show="show_user_bar"
        x-swipe:right="show_user_bar = false"
        
        x-transition:enter="transition duration-250"
        x-transition:enter-start="transform translate-x-full opacity-0 scale-90"
        x-transition:enter-end="transform translate-x-0 opacity-100 scale-100"
        x-transition:leave="transition duration-250"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform translate-x-full opacity-0 scale-90"

        hx-get="/components/user_bar"
        hx-trigger="load"
    >
    </aside>

</body>
</html>

<?php endif ?>
