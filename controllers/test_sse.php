<?php
ini_set('max_execution_time', 0);

//require_once("../vendor/autoload.php");

use Fzb;

$pub = new Redis();
$sub = new Redis();
$pub->connect('127.0.0.1');
$sub->connect('127.0.0.1');
$sub->setOption(Redis::OPT_READ_TIMEOUT, 10);

$session_id = $auth->user_session->id ?? 'n/a';
$pid = getmypid();
$id_string = sprintf("IP: %s (%s), SID: %s", $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_X_FORWARDED_FOR'] ?? 'n/a', $session_id);

$pub->publish('chat', "client connected: $id_string, PID: $pid");

$sse = new Fzb\SSE(
    event_stream: function ($sse) use ($pub, $sub, $id_string, $pid) {
        try {
            $sub->subscribe(['chat'], function ($sub, $channel, $message) use ($pub, $sse, $id_string, $pid) {
                // check for user hitting the refresh button, kill hanging event stream
                if (str_contains($message, "client connected: $id_string")) {
                    //$pub->publish('chat', "PID: $pid saw reconnect.  Disconnecting...");
                    //die();
                }

                if (str_contains($message, 'chat-message')) {
                    $sse->message($message, "something");
                }
            });
        } catch (RedisException $e) {
            // on sub read timeout, send ping
            $pub->publish('chat', "ping: $id_string, PID: $pid");
            $sse->message('ping', 'ping');
        }
    },

    shutdown: function () use ($pub, $sub, $id_string, $pid) {
        $pub->publish('chat', "client disconnected: $id_string, PID: $pid");
        $pub->close();
        $sub->close();
        die();
    }
);