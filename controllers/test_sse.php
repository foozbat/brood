<?php
date_default_timezone_set("America/New_York");
header("X-Accel-Buffering: no");
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");


while (!connection_aborted()) {
    echo "event: chat-message" . PHP_EOL;
    echo "id: " . rand(1000000,2000000) . PHP_EOL;
    echo "data: something" . PHP_EOL;

    echo PHP_EOL;

    ob_end_flush();
    flush();

    sleep(rand(1, 10));
}