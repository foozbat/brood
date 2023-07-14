<?php
header("Cache-Control: no-store");
header("Content-Type: text/event-stream");

while (true) {

  echo "event: message\n";
  echo "data: <div>something</div>\n\n";


  ob_end_flush();
  flush();


  if (connection_aborted()) break;

  sleep(1);
}