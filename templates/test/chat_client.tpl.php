<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title><?php echo "unnamed.chat" ?></title>
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
  <script src="https://unpkg.com/htmx.org@1.9.2"></script>
  <script src="https://unpkg.com/htmx.org/dist/ext/ws.js"></script>
  <script src="https://unpkg.com/htmx.org/dist/ext/morphdom-swap.js"></script>

</head>

<body class="bg-gray-100 text-gray-700">
    <div id="chat_room">
        CHAT ROOM
    </div>

    <div id="null" style="display:none"></div>

    <div hx-ext="ws" ws-connect="/ws/chat_server" hx-target="#null">
        <form id="form" ws-send>
            <input name="chat_message">
        </form>
    </div>

</body>
</html>