<?php
date_default_timezone_set("America/New_York");
header("X-Accel-Buffering: no");
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");

$pub = new Redis();
$sub = new Redis();
$pub->connect('127.0.0.1');
$sub->connect('127.0.0.1');
$sub->setOption(Redis::OPT_READ_TIMEOUT, 10);

$pub->publish('chat', "client connected, PID:".getmypid());

while (!connection_aborted()) {
    try {
        $sub->subscribe(['chat'], function ($sub, $channel, $message) use ($pub) {
            if (str_contains($message, "client connected")) {
                echo "SAW SOMEONE";
                $pub->publish('chat', "PID:".getmypid()." saw someone connect");
            }

            if (str_contains($message, 'chat-message')) {
                send_message($message, rand(1000000,2000000), "something");
            }
        });
    } catch (RedisException $e) {
        // on sub read timeout, send ping
        send_message('ping', rand(1000000,2000000), 'ping');
    }
}

$pub->publish('chat', "client disconnected, PID:".getmypid());
$pub->close();
$sub->close();
echo "closed";

function send_message($message, $id, $data) {
    echo "event: $message" . PHP_EOL;
    echo "data: {}" . PHP_EOL;
    echo PHP_EOL;

    ob_end_flush();
    flush();
}