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
    <script src="/static/htmx.min.js"></script>
    <script src="https://unpkg.com/alpinejs-swipe@1.0.2/dist/cjs.js"></script>
    <script defer src="/static/alpinejs.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>

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
    }"
    x-on:resize.window="
        prev_mobile = is_mobile;
        is_mobile = !window.matchMedia('(min-width: 1024px)').matches;

        if (is_mobile && !prev_mobile) {
            show_main_bar = false;
            show_user_bar = false;
        } else if (!is_mobile && prev_mobile) {
            show_main_bar = true;
            show_user_bar = true;
        }
    "
    
>

    <!-- header page -->
    <?php $top_bar() ?>

     <!-- container for main sections -->
    
        <!-- main sidebar -->
        <div 
            class="
                h-[calc(100%-4rem)]
                top-16
                fixed
                overflow-y-auto
                z-10
                w-72 lg:w-64 xl:w-72
            "

            hx-get="/components/main_bar"
            hx-trigger="load"

            x-show="show_main_bar"
            x-swipe:left="show_main_bar = false"
            @click.away="(is_mobile ? show_main_bar = false : '')"

            x-transition:enter="transition duration-250"
            x-transition:enter-start="transform -translate-x-full opacity-0 scale-90"
            x-transition:enter-end="transform translate-x-0 opacity-100 scale-100"
            x-transition:leave="transition duration-250"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform -translate-x-full opacity-0 scale-90"
        >
        </div>
        
        <!-- main content page -->
        <div 
            id="content_area"
            class="
                flex
                w-full
                pt-16
                z-10
                flex flex-col
            "
            :class="{ 
                'pl-0 lg:pl-64 xl:pl-72': show_main_bar,
                'pl-0 lg:pl-32 xl:pl-48': !show_main_bar,

                'pr-0 lg:pr-48 xl:pr-64': show_user_bar,
                'pr-0 lg:pr-32 xl:pr-48': !show_user_bar,
            }"

            x-swipe:right.threshold.100px="
                if (!show_main_bar && !show_user_bar) {
                    show_main_bar = true;
                }
            ",
            x-swipe:left.threshold.100px="
                if (!show_user_bar && !show_main_bar) {
                    show_user_bar = true;
                }
            "
        >
<!--
            :class="{ 
                'pl-72': show_main_bar,
                'pr-72': show_user_bar
            }"
-->    
            <?php $content() ?>

        </div>

        <!-- user sidebar -->
        <div 
            class="
                h-[calc(100%-4rem)]
                top-16 pb-2
                right-0 fixed
                overflow-y-auto 
                z-10
                w-64 lg:w-48 xl:w-64
            "

            hx-get="/components/user_bar"
            hx-trigger="load"

            x-show="show_user_bar"
            x-swipe:right="show_user_bar = false"
            @click.away="(is_mobile ? show_user_bar = false : '')"

            x-transition:enter="transition duration-250"
            x-transition:enter-start="transform translate-x-full opacity-0 scale-90"
            x-transition:enter-end="transform translate-x-0 opacity-100 scale-100"
            x-transition:leave="transition duration-250"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform translate-x-full opacity-0 scale-90"
        >
        </div>

        <?php $page_footer() ?>

</body>
</html>

<?php endif ?>
