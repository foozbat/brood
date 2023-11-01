<?php 
/**
 * Main Page Layout Template (extendable)
 */

require "components/page_footer.tpl.php"; 
require "components/top_bar.tpl.php"; 

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
    <script src="https://unpkg.com/htmx.org@1.9.6" integrity="sha384-FhXw7b6AlE/jyjlZH5iHa/tTe9EpJ1Y55RjcgPbjeWMskSxZt1v9qkxLJWNJaGni" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/htmx.org/dist/ext/sse.js"></script>
    <script src="https://unpkg.com/alpinejs-swipe@1.0.2/dist/cjs.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="/static/brood-common.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>

    <script>
        // move all this into a .js file

        document.addEventListener('alpine:init', () => {
            //console.log('Alpine Init');

            Alpine.data('dropdown', () => ({
                open: false,

                toggle() {
                    this.open = !this.open;
                },
                click_away() {
                    if (this.open) {
                        Alpine.store('htmx').await_snapshot().then(() => {
                            this.open = false;
                        });
                    }
                }
            }));
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

    x-swipe:right.threshold.100px="
        show_user_bar = false;

        if (!show_main_bar && !show_user_bar) {
            show_main_bar = true;
        }
    "
    x-swipe:left.threshold.100px="
        show_main_bar = false;

        if (!show_user_bar && !show_main_bar) {
            show_user_bar = true;
        }
    "
>
    <!-- header page -->
    <!--<header
        hx-get="/components/top_bar"
        hx-trigger="load"
        hx-swap="outerHTML">
    </header>-->
    <?php $top_bar() ?>

    <!-- main sidebar -->
    <nav
        id="main_bar"
        x-ref="main_bar"


        class="
            h-[calc(100%-<?= $top_bar_height ?>rem)]
            fixed
            w-72 lg:w-64 xl:w-72
            overflow-y-auto
            z-20
            scrollbar-thin
        "

        x-show="show_main_bar"
        x-swipe:left="show_main_bar = false"

        @click.away="$store.htmx.await_snapshot().then(() => { 
            if (show_main_bar && is_mobile) {
                show_main_bar = false; 
            }
        })"
    
        x-transition:enter="transition duration-250"
        x-transition:enter-start="transform -translate-x-full opacity-0 scale-90"
        x-transition:enter-end="transform translate-x-0 opacity-100 scale-100"
        x-transition:leave.delay="transition duration-250"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform -translate-x-full opacity-0 scale-90"
    >
        <div
            hx-get="/components/main_bar"
            hx-trigger="load"
            hx-swap="outerHTML">
        </div>
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
            w-64 lg:w-48 xl:w-64
            overflow-y-auto 
            z-10
            scrollbar-thin
        "

        x-show="show_user_bar"
        x-swipe:right="show_user_bar = false"
        
        @click.away="$store.htmx.await_snapshot().then(() => { 
            if (show_user_bar && is_mobile) {
                show_user_bar = false; 
            }
        })"

        x-transition:enter="transition duration-250"
        x-transition:enter-start="transform translate-x-full opacity-0 scale-90"
        x-transition:enter-end="transform translate-x-0 opacity-100 scale-100"
        x-transition:leave="transition duration-250"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform translate-x-full opacity-0 scale-90"
    >
        <div
            hx-get="/components/user_bar"
            hx-trigger="load"
            hx-swap="outerHTML">
        </div>
    </aside>

</body>
</html>

<?php endif ?>
