<?php
header("Cache-Control: no-store");
header("Content-Type: text/event-stream");

while (true) {

  echo "event: chat-message\n";
  echo "data: <div>something</div>\n\n";

  flush();


  if (connection_aborted()) break;

  sleep(1);
}