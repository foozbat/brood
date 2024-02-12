<?php

use Fzb;

$pub = new Redis();
$sub = new Redis();
$pub->connect('127.0.0.1');
$sub->connect('127.0.0.1');
$sub->setOption(Redis::OPT_READ_TIMEOUT, 10);

$pub->publish('chat', "client connected, PID:".getmypid());

$sse = new Fzb\SSE();
$sse->stream(function () use ($pub, $sub, $sse) {
    try {
        $sub->subscribe(['chat'], function ($sub, $channel, $message) use ($pub, $sse) {
            if (str_contains($message, "client connected")) {
                echo "SAW SOMEONE";
                $pub->publish('chat', "PID:".getmypid()." saw someone connect");
            }

            if (str_contains($message, 'chat-message')) {
                $sse->message($message, "something");
            }
        });
    } catch (RedisException $e) {
        // on sub read timeout, send ping
        $sse->message('ping', 'ping');
    }
});

$pub->publish('chat', "client disconnected, PID:".getmypid());
$pub->close();
$sub->close();