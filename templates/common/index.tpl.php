<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title><?php echo "Megaboard X" ?></title>
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
<body class="min-h-screen w-full bg-gray-100 text-gray-700" x-data="{ sidebar_expanded: true }">
  <!-- header page -->
  <header class="flex w-full fixed items-center justify-between border-b-2 border-gray-200 bg-white p-2">
    <!-- logo -->
    <div class="flex items-center space-x-2">
      <button type="button" class="text-3xl" @click="sidebar_expanded = !sidebar_expanded"><i class="bx bx-menu"></i></button>
      <div class="text-3xl">Megaboard<span class="text-red-800 font-bold">X</span></div>
    </div>

    <!-- button profile -->
    <div x-data="{ profileOpen: false }">
      <button type="button" @click="profileOpen = !profileOpen" @click.outside="profileOpen = false"
        class="h-9 w-9 overflow-hidden rounded-full">
        <img src="https://plchldr.co/i/40x40?bg=111111" alt="plchldr.co" />
      </button>

      <!-- dropdown profile -->
      <div class="absolute right-2 mt-1 w-48 divide-y divide-gray-200 rounded-md border border-gray-200 bg-white shadow-md"
        x-show="profileOpen" x-transition>
        <div class="flex items-center space-x-2 p-2">
          <img src="https://plchldr.co/i/40x40?bg=111111" alt="plchldr.co" class="h-9 w-9 rounded-full" />
          <div class="font-medium">Some User</div>
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

  <div class="h-16 w-full"></div>

  <div class="flex">
    <!-- mini sidebar -->
    <div class="flex flex-col md:flex h-screen overflow-y-auto p-2" style="top: 100px;" 
      x-show="!sidebar_expanded"
      x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0 "
      x-transition:enter-end="opacity-100 "
      x-transition:leave="transition ease-in duration-300"
      x-transition:leave-start="opacity-100 "
      x-transition:leave-end="opacity-0 ">
      <div class="flex flex-col space-y-2 border-r-2 border-b-2 border-gray-300 bg-gray-200 p-4 rounded-md">
        <i class="bx bxs-conversation text-3xl"></i>

        <i class="bx bxs-message-rounded-dots text-3xl"></i>

        <i class="bx bxs-videos text-3xl"></i>
      </div>
    </div>
    
    <!-- sidebar -->
    <div class="flex flex-col w-72 md:flex h-screen overflow-y-auto p-2"  style="top: 100px;" 
      x-show="sidebar_expanded"
      x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0 "
      x-transition:enter-end="opacity-100 "
      x-transition:leave="transition ease-in duration-300"
      x-transition:leave-start="opacity-100 "
      x-transition:leave-end="opacity-0 ">
      <div class="flex flex-col space-y-1 border-r-2 border-b-2 border-gray-300 bg-gray-200 p-2 mb-2 rounded-md">
     
        <span class="text-lg pb-2">
          <i class="bx bxs-conversation text-2xl"></i>
          Forums
        </span>

        <span class="text-sm uppercase font-bold">General Discussion</span>

        <a href="#" class="flex items-center space-x-1 rounded-md px-2 hover:bg-gray-100 hover:text-red-600">
          <span class="text-lg"><i class="bx bx-comment-detail"></i></span>
          <span class="text-sm">Discussion</span>
          <span class="px-2 py-1 text-xs font-bold leading-none text-red-100 transform bg-red-600 rounded-full">9</span>
        </a>

        <a href="#" class="flex items-center space-x-1 rounded-md px-2 hover:bg-gray-100 hover:text-red-600">
          <span class="text-lg"><i class="bx bx-comment-detail"></i></span>
          <span class="text-sm">News and Current Events</span>
          <span class="px-2 py-1 text-xs font-bold leading-none text-red-100 transform bg-red-600 rounded-full">1</span>
        </a>

        <a href="#" class="flex items-center space-x-1 rounded-md px-2 hover:bg-gray-100 hover:text-red-600">
          <span class="text-lg"><i class="bx bx-comment-detail"></i></span>
          <span class="text-sm">Off Topic</span>
        </a>

        <span class="text-sm uppercase font-bold">Tech Talk</span>

        <a href="#" class="flex items-center space-x-1 rounded-md px-2 hover:bg-gray-100 hover:text-red-600">
          <span class="text-lg"><i class="bx bx-comment-detail"></i></span>
          <span class="text-sm">Programming</span>
        </a>

        <a href="#" class="flex items-center space-x-1 rounded-md px-2 hover:bg-gray-100 hover:text-red-600">
          <span class="text-lg"><i class="bx bx-comment-detail"></i></span>
          <span class="text-sm">Graphic Design</span>
        </a>

        <a href="#" class="flex items-center space-x-1 rounded-md px-2 hover:bg-gray-100 hover:text-red-600">
          <span class="text-lg"><i class="bx bx-comment-detail"></i></span>
          <span class="text-sm">Raspberry Pi and Embedded</span>
        </a>

        <a href="#" class="flex items-center space-x-1 rounded-md px-2 hover:bg-gray-100 hover:text-red-600">
          <span class="text-lg"><i class="bx bx-comment-detail"></i></span>
          <span class="text-sm">Home Audio/Video</span>
        </a>

        <a href="#" class="flex items-center space-x-1 rounded-md px-2 hover:bg-gray-100 hover:text-red-600">
          <span class="text-lg"><i class="bx bx-comment-detail"></i></span>
          <span class="text-sm">Live Streaming</span>
        </a>

      </div>

      <div class="flex flex-col space-y-1 border-r-2 border-b-2 border-gray-300 bg-gray-200 p-2 mb-2 rounded-md">

        <span class="text-lg pb-2">
          <i class='bx bxs-message-rounded-dots text-2xl' ></i>
          Chat
        </span>

        <span class="text-sm uppercase font-bold">Text Channels</span>

        <a href="#" class="flex items-center space-x-1 rounded-md px-2 hover:bg-gray-100 hover:text-red-600">
          <span class="text-lg"><i class="bx bx-hash"></i></span>
          <span class="text-sm">welcome</span>
        </a>

        <a href="#" class="flex items-center space-x-1 rounded-md px-2 hover:bg-gray-100 hover:text-red-600">
          <span class="text-lg"><i class="bx bx-hash"></i></span>
          <span class="text-sm">general</span>
        </a>

        <a href="#" class="flex items-center space-x-1 rounded-md px-2 hover:bg-gray-100 hover:text-red-600">
          <span class="text-lg"><i class="bx bx-hash"></i></span>
          <span class="text-sm">announcements</span>
        </a>

        <a href="#" class="flex items-center space-x-1 rounded-md px-2 hover:bg-gray-100 hover:text-red-600">
          <span class="text-lg"><i class="bx bx-hash"></i></span>
          <span class="text-sm">off-topic</span>
        </a>

        <a href="#" class="flex items-center space-x-1 rounded-md px-2 hover:bg-gray-100 hover:text-red-600">
          <span class="text-lg"><i class="bx bx-hash"></i></span>
          <span class="text-sm">cat-memes</span>
        </a>

      </div>

      <div class="flex flex-col space-y-1 border-r-2 border-b-2  border-gray-300 bg-gray-200 p-2 mb-2 rounded-md">


        <span class="text-lg pb-2">
          <i class='bx bxs-videos text-2xl' ></i>
          Streams
        </span>

        <span class="text-sm uppercase font-bold">A category</span>

        <a href="#" class="flex items-center space-x-1 rounded-md px-2 hover:bg-gray-100 hover:text-red-600">
            <span class="text-lg"><i class="bx bx-video"></i></span>
            <span class="text-sm">Cat Video</span>
            <span class="px-2 py-1 text-xs font-bold leading-none text-red-100 transform bg-red-600 rounded-full">LIVE</span>
        </a>
      </div>
    </div>
    <!--</aside>-->

    <!-- main content page -->
    <div class="w-full p-2">
      
      <div class="bg-white rounded-md border-r-2 border-b-2 border-gray-300 p-4 mb-4">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Expedita quam odit officiis
        magni doloribus ipsa dolore, dolores nihil accusantium labore, incidunt autem iure quae vitae voluptate,
        esse asperiores aliquam repellat. Harum aliquid non officiis porro at cumque eaque inventore iure. Modi sunt
        optio mollitia repellat sed ab quibusdam quos harum!
      </div>

      <div class="bg-white rounded-md border-r-2 border-b-2 border-gray-300 p-4 mb-4">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Expedita quam odit officiis
        magni doloribus ipsa dolore, dolores nihil accusantium labore, incidunt autem iure quae vitae voluptate,
        esse asperiores aliquam repellat. Harum aliquid non officiis porro at cumque eaque inventore iure. Modi sunt
        optio mollitia repellat sed ab quibusdam quos harum!
      </div>      
    </div>

    <!-- right sidebar -->

    
    <div class="flex flex-col w-72 md:flex h-screen overflow-y-auto p-2">

      <div class="flex flex-col space-y-1 border-r-2 border-b-2 border-gray-300 bg-gray-200 p-2 mb-2 rounded-md">

        <span class="text-lg pb-2">
          <i class='bx bxs-user text-2xl' ></i>
          Online Now
        </span>

        <div class="flex items-center space-x-4 w-100 pb-2 rounded-md hover:bg-gray-100">
          <div class="inline-flex overflow-hidden relative justify-center items-center w-8 h-8 bg-gray-100 rounded-full dark:bg-gray-600">
            <span class="text-sm text-gray-600">SG</span> 
          </div>
          
          <div>
              <div class="text-sm">Some Guy</div>
              <div class="text-xs text-gray-500">Doing something</div>
          </div>
        </div>


        <div class="flex items-center space-x-4 w-100 pb-2 rounded-md hover:bg-gray-100">
          <div class="inline-flex overflow-hidden relative justify-center items-center w-8 h-8 bg-gray-100 rounded-full dark:bg-gray-600">
            <span class="text-sm text-gray-600">JP</span> 
          </div>
          <div>
              <div class="text-sm">Jean-luc Picard</div>
              <div class="text-xs text-gray-500 dark:text-gray-400">Commanding stuff</div>
          </div>
        </div>

        <div class="flex items-center space-x-4 w-100 pb-2 rounded-md hover:bg-gray-100">
          <div class="inline-flex overflow-hidden relative justify-center items-center w-8 h-8 bg-gray-100 rounded-full dark:bg-gray-600">
            <span class="text-sm text-gray-600">WR</span> 
          </div>
          <div>
              <div class="text-sm">William Riker</div>
              <div class="text-xs text-gray-500">Fighting</div>
          </div>
        </div>

        <div class="flex items-center space-x-4 w-100 pb-2 rounded-md hover:bg-gray-100">
          <div class="inline-flex overflow-hidden relative justify-center items-center w-8 h-8 bg-gray-100 rounded-full dark:bg-gray-600">
            <span class="text-sm text-gray-600 dark:text-gray-300">DT</span> 
          </div>
          <div>
              <div class="text-sm">Deanna Troi</div>
              <div class="text-xs text-gray-500">Mind reading</div>
          </div>
        </div>
        
        <div class="flex items-center space-x-4 w-100 pb-2 rounded-md hover:bg-gray-100">
          <div class="inline-flex overflow-hidden relative justify-center items-center w-8 h-8 bg-gray-100 rounded-full dark:bg-gray-600">
            <span class="text-sm text-gray-600">D</span> 
          </div>
          <div>
              <div class="text-sm">Data</div>
              
          </div>
        </div>

      </div>
    </div>


  </div>
</body>

</html>
