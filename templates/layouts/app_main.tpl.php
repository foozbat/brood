<?php require "components/page_header.tpl.php"; ?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title><?php echo "megaboard.chat" ?></title>
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

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/htmx.org@1.8.2" integrity="sha384-+8ISc/waZcRdXCLxVgbsLzay31nCdyZXQxnsUy++HJzJliTzxKWr0m1cIEMyUzQu" crossorigin="anonymous"></script>
</head>

<!-- page -->
<body 
    class="
        min-h-screen w-full 
        bg-zinc-100 dark:bg-zinc-900 
        text-zinc-700 dark:text-zinc-300
    "
    x-data="{ sidebar_expanded: true }"
>
    <!-- header page -->
    <?php $page_header() ?>

     <!-- container for main sections -->
    <div class="flex pt-16 h-[calc(100vh)]">
        <!-- main sidebar -->
        <div 
            class="
                h-full w-96 
                overflow-y-auto
                p-2
            "
            hx-get="/components/main_bar"
            hx-trigger="load"
        >
        </div> 

        <!-- main content page -->
        <div class="
            h-full w-full 
            overflow-y-auto
            pt-2 pb-2
        ">
            <?php $content() ?>
        </div>

        <!-- user sidebar -->
        <div 
            class="
                h-full w-96
                overflow-y-auto 
                p-2
            "
            hx-get="/components/user_bar"
            hx-trigger="load"
        >
        </div>
    </div>
</body>

</html>
