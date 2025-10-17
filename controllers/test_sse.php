<?php
ini_set('max_execution_time', 0);
ini_set('error_log', __DIR__ . '/php_errors.log');

//require_once("../vendor/autoload.php");

$pub = new Redis();
$sub = new Redis();
$pub->connect('redis', 6379);

$session_id = $auth->user_session->id ?? 'n/a';
$pid = getmypid();
$id_string = sprintf("IP: %s (%s), SID: %s", $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_X_FORWARDED_FOR'] ?? 'n/a', $session_id);

$pub->publish('chat', "client connected: $id_string, PID: $pid");

$sse = new Fzb\SSE(
    event_stream: function ($sse) use ($pub, $sub, $id_string, $pid) {
        try {
            // connect/reconnect subscriber
            $sub->connect('redis', 6379, 0);
            $sub->setOption(Redis::OPT_READ_TIMEOUT, 10);

            $return = $sub->subscribe(['chat'], function ($sub, $channel, $message) use ($pub, $sse, $id_string, $pid) {
                // check for user hitting the refresh button, kill hanging event stream
                if (str_contains($message, "client connected: $id_string")) {
                    //$pub->publish('chat', "PID: $pid saw reconnect.  Disconnecting...");
                    //die();
                }

                if (str_contains($message, 'chat-message')) {
                    $sse->message($message, "something");
                }
            });
            $sse->message('return', "Return: " . print_r($return, true));
        } catch (RedisException $e) {
            // on sub read timeout, send ping
            $sse->message('ping', 'ping');
        } catch (Exception $e) {
            $sse->message('error', 'Error occurred: ' . $e->getMessage());
            exit();
        }
    },

    shutdown: function () use ($pub, $sub, $id_string, $pid) {
        $pub->publish('chat', "client disconnected: $id_string, PID: $pid");
        $pub->close();
        $sub->close();
        die();
    }
);