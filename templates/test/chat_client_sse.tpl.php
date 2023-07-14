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
  <script src="https://unpkg.com/htmx.org/dist/ext/sse.js"></script>

</head>

<body class="bg-gray-100 text-gray-700">
    <div hx-ext="sse" sse-connect="/chat_server_sse" sse-swap="message" hx-swap="beforeend">
      Contents of this box will be updated in real time
      with every SSE message received from the chatroom.
  </div>

</body>
</html>