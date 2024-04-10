<?php 
/**
 * Main Page Layout Template (extendable)
 */

require_once "components/page_footer.tpl.php"; 
require_once "components/modal.tpl.php";
require_once "components/breadcrumb.tpl.php";

use Fzb\Htmx;

?>
<?php if (Htmx::is_htmx_request()): ?>
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
    <link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet">

    <script src="https://unpkg.com/htmx.org@1.9.10" integrity="sha384-D1Kt99CQMDuVetoL1lrYwg5t+9QdHe7NLX/SoJYkXDFfX37iInKRy5xLSi8nO7UC" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/htmx.org/dist/ext/sse.js"></script>
    <script src="https://unpkg.com/alpinejs-swipe@1.0.2/dist/cjs.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/maxeckel/alpine-editor@0.3.1/dist/alpine-editor.min.js"></script>
    
    <script src="/static/brood-common.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<!-- page -->
<body 
    x-ref="body"
    class="
        h-screen w-full
        flex flex-col
        bg-zinc-200 dark:bg-zinc-900 
        text-zinc-700 dark:text-zinc-300
        bg-no-repeat
    "
>
    <!-- header page -->
    <header 
        class="w-full z-0"
        style="height: <?= $top_bar_height ?>rem"

        hx-get="/components/top_bar"
        hx-trigger="load, user-login-success from:body, user-logout from:body"
    ></header>
    <!---->

    <div class="flex-1 h-full overflow-hidden">

    <!-- main sidebar -->
    <nav
        x-data="side_bar"

        class="
            fixed h-full
            w-72 lg:w-64 xl:w-72
            overflow-y-auto
            z-10
            scrollbar-thin
        "

        x-show="open"

        x-swipe:left="hide()"
        @click.away="click_away()"
        @show-main-bar.window="show()"
        @hide-main-bar.window="hide()"
        @toggle-main-bar.window="toggle()"
    
        x-transition:enter="transition duration-250"
        x-transition:enter-start="transform -translate-x-full opacity-0 scale-90"
        x-transition:enter-end="transform translate-x-0 opacity-100 scale-100"
        x-transition:leave.delay="transition duration-250"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform -translate-x-full opacity-0 scale-90"

        hx-get="/components/main_bar"
        hx-trigger="load"
    ></nav>

    <!-- user sidebar -->
    <aside
        x-data="side_bar"

        class="
            right-0 fixed h-full
            w-64 lg:w-48 xl:w-64
            overflow-y-auto 
            z-10
            scrollbar-thin
        "

        x-show="open"

        x-swipe:right="hide()"
        @click.away="click_away()"
        @show-user-bar.window="show()"
        @hide-user-bar.window="hide()"
        @toggle-user-bar.window="toggle()"

        x-transition:enter="transition duration-250"
        x-transition:enter-start="transform translate-x-full opacity-0 scale-90"
        x-transition:enter-end="transform translate-x-0 opacity-100 scale-100"
        x-transition:leave="transition duration-250"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform translate-x-full opacity-0 scale-90"

        hx-get="/components/user_bar"
        hx-trigger="load, user-login-success from:body, user-logout from:body"
    ></aside>

    <div 
        class="
            w-full
            
            text-center

        "
        x-data="{ show: false }"
        x-show="show"
        @toggle-search-bar.window = "show = !show"
    >
        <input type="text" class="bg-black rounded-md"></input>
    </div>

    <!-- main content area -->
    <main 
        id="content_area"
        x-ref="content_area"

        hx-history-elt

        x-data="{
            main_bar_shown: true,
            user_bar_shown: true,
        }"

        class="
            pl-0 pr-0
            overflow-y-auto
            flex flex-col h-full
        "

        :class="{ 
            'lg:pl-64 xl:pl-72': main_bar_shown,
            'lg:pl-16 xl:pl-32': !main_bar_shown,
            'lg:pr-48 xl:pr-64': user_bar_shown,
            'lg:pr-16 xl:pr-32': !user_bar_shown,
        }"

        @show-main-bar.window="main_bar_shown = true;"
        @hide-main-bar.window="main_bar_shown = false;"
        @toggle-main-bar.window="main_bar_shown = !main_bar_shown"
        @show-user-bar.window="user_bar_shown = true;"
        @hide-user-bar.window="user_bar_shown = false;"
        @toggle-user-bar.window="user_bar_shown = !user_bar_shown"

        
    >
        <?php $content() ?>
    </main>

    </div>

    <?php modal_container() ?>
</body>
</html>

<?php endif ?>
