<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>Megaboard X</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta property="og:title" content="">
  <meta property="og:type" content="">
  <meta property="og:url" content="">
  <meta property="og:image" content="">

  <!--<link rel="manifest" href="site.webmanifest">-->
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="static/app.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script src="https://unpkg.com/htmx.org@1.8.2" integrity="sha384-+8ISc/waZcRdXCLxVgbsLzay31nCdyZXQxnsUy++HJzJliTzxKWr0m1cIEMyUzQu" crossorigin="anonymous"></script>
</head>

<!-- page -->
<main class="min-h-screen w-full bg-gray-100 text-gray-700" x-data="layout">
    <!-- header page -->
    <header class="flex w-full items-center justify-between border-b-2 border-gray-200 bg-white p-2">
        <!-- logo -->
        <div class="flex items-center space-x-2">
            <button type="button" class="text-3xl" @click="asideOpen = !asideOpen"><i class="bx bx-menu"></i></button>
            <div>Logo</div>
        </div>

        <!-- button profile -->
        <div>
            <button type="button" @click="profileOpen = !profileOpen" @click.outside="profileOpen = false"
                class="h-9 w-9 overflow-hidden rounded-full">
                <img src="https://plchldr.co/i/40x40?bg=111111" alt="plchldr.co" />
            </button>

            <!-- dropdown profile -->
            <div class="absolute right-2 mt-1 w-48 divide-y divide-gray-200 rounded-md border border-gray-200 bg-white shadow-md"
                x-show="profileOpen" x-transition>
                <div class="flex items-center space-x-2 p-2">
                    <img src="https://plchldr.co/i/40x40?bg=111111" alt="plchldr.co" class="h-9 w-9 rounded-full" />
                    <div class="font-medium">Hafiz Haziq</div>
                </div>

                <div class="flex flex-col space-y-3 p-2">
                    <a href="#" class="transition hover:text-red-600">My Profile</a>
                    <a href="#" class="transition hover:text-red-600">Edit Profile</a>
                    <a href="#" class="transition hover:text-red-600">Settings</a>
                </div>

                <div class="p-2">
                    <button class="flex items-center space-x-2 transition hover:text-red-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        <div>Log Out</div>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div class="flex">
        <!-- aside -->
        <aside class="flex w-64 flex-col space-y-1 border-r-2 border-gray-200 bg-white p-2" style="height: 100vh"
            x-show="asideOpen">
            Forums
            <a href="#" class="flex items-center space-x-1 rounded-md px-2 py-1 hover:bg-gray-100 hover:text-red-600">
                <span class="text-2xl"><i class="bx bx-conversation"></i></span>
                <span>Discussion</span>
            </a>

            <a href="#" class="flex items-center space-x-1 rounded-md px-2 py-1 hover:bg-gray-100 hover:text-red-600">
                <span class="text-2xl"><i class="bx bx-conversation"></i></span>
                <span>Another Forum</span>
            </a>

            <b>Chat</b>
            <span class="text-sm uppercase">Text Channels</span>

            <a href="#" class="flex items-center space-x-1 rounded-md px-2 py-0 hover:bg-gray-100 hover:text-red-600">
                <span class="text-2xl"><i class="bx bx-hash"></i></span>
                <span>welcome</span>
            </a>

            <a href="#" class="flex items-center space-x-1 rounded-md px-2 py-0 hover:bg-gray-100 hover:text-red-600">
                <span class="text-2xl"><i class="bx bx-hash"></i></span>
                <span>general</span>
            </a>

            <a href="#" class="flex items-center space-x-1 rounded-md px-2 py-0 hover:bg-gray-100 hover:text-red-600">
                <span class="text-2xl"><i class="bx bx-hash"></i></span>
                <span>announcements</span>
            </a>

            <a href="#" class="flex items-center space-x-1 rounded-md px-2 py-0 hover:bg-gray-100 hover:text-red-600">
                <span class="text-2xl"><i class="bx bx-hash"></i></span>
                <span>off-topic</span>
            </a>

            <a href="#" class="flex items-center space-x-1 rounded-md px-2 py-0 hover:bg-gray-100 hover:text-red-600">
                <span class="text-2xl"><i class="bx bx-hash"></i></span>
                <span>Profile</span>
            </a>
        </aside>

        <!-- main content page -->
        <div class="w-full p-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Expedita quam odit officiis
            magni doloribus ipsa dolore, dolores nihil accusantium labore, incidunt autem iure quae vitae voluptate,
            esse asperiores aliquam repellat. Harum aliquid non officiis porro at cumque eaque inventore iure. Modi sunt
            optio mollitia repellat sed ab quibusdam quos harum!</div>
    </div>
</main>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("layout", () => ({
            profileOpen: false,
            asideOpen: true,
        }));
    });
</script>

</html>
