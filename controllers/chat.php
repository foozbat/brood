<?php

use Fzb\Input, Fzb\Renderer;

$renderer = new Renderer();

$router->use_controller_prefix();

$router->get(
    "/{url_id}/messages", 
    "/{url_id}/messages/{num}",
    function () use ($renderer) {
        list($url_id, $num, $validation) = Input::from_request(
            url_id: 'path required',
            num: 'path validate:int default:25'
        );

        $lorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Posuere lorem ipsum dolor sit amet consectetur adipiscing elit. Enim facilisis gravida neque convallis a cras semper auctor neque. Vel eros donec ac odio tempor orci. Donec pretium vulputate sapien nec sagittis aliquam malesuada. Vitae suscipit tellus mauris a diam. Vitae semper quis lectus nulla at volutpat diam. Scelerisque varius morbi enim nunc faucibus a pellentesque. At urna condimentum mattis pellentesque id nibh tortor id aliquet. Suspendisse faucibus interdum posuere lorem ipsum dolor sit. In hac habitasse platea dictumst quisque sagittis purus sit amet. Porttitor lacus luctus accumsan tortor posuere ac ut consequat. Maecenas accumsan lacus vel facilisis volutpat est velit. Pharetra vel turpis nunc eget. Auctor augue mauris augue neque gravida. Nunc mattis enim ut tellus. Ipsum a arcu cursus vitae congue mauris rhoncus aenean.";
        $lorems = explode(". ", $lorem);

        $chats = [];

        for ($i=0; $i<$num; $i++) {
            $chats[$i] = [
                'chat_id' => rand(1,1000000),
                'poster' => 'Poster ' . $i, 
                'content' => join(". ", array_slice($lorems, rand(0,5), rand(1,6)))
            ];
        }

        $renderer->set("chats", $chats);
        $renderer->show("fragments/chat_message.tpl.php");
});

/**
 * Send a chat message
 */
$router->post("/{url_id}/send", function () use ($redis, $auth) {
    $auth->login_required();
    
    list($url_id, $content, $validation) = Input::from_request(
        url_id: 'path required',
        content: 'post required'
    );

    $message = new Message(
        channel_id: $channel_id,
        user_id: $auth->user->id,
        content: $content
    );
    $message->save();

    $redis->publish('chat', 'chat-message');
});

/**
 * Event stream for chat room
 */
$router->get("/{url_id}/stream", function () use ($redis, $auth) {
    ini_set('max_execution_time', 0);

    list($url_id, $validation) = Input::from_request(
        url_id: 'path required'
    );

    $session_id = $auth->user_session->id ?? 'n/a';
    $pid = getmypid();
    $id_string = sprintf("IP: %s (%s), SID: %s", $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_X_FORWARDED_FOR'] ?? 'n/a', $session_id);

    $redis->publish('chat', "client connected: $id_string, PID: $pid");

    $sse = new Fzb\SSE(
        event_stream: function ($sse) use ($redis, $id_string, $pid) {
            try {
                // connect/reconnect subscriber
                $redis->connect($_ENV['REDIS_HOST'], $_ENV['REDIS_PORT']);
                $redis->setOption(Redis::OPT_READ_TIMEOUT, 10);

                $return = $redis->subscribe(['chat'], function ($redis, $channel, $message) use ($sse, $id_string, $pid) {
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

        shutdown: function () use ($redis, $id_string, $pid) {
            $redis->publish('chat', "client disconnected: $id_string, PID: $pid");
            $redis->close();
            die();
        }
    );
});

/**
 * Default page chat room
 */
$router->get("/{url_id}", function () use ($renderer) {
    list($url_id, $validation) = Input::from_request(
        url_id: 'path required'
    );

    if (!Channel::exists($url_id)) {
        $renderer->set("error", "Channel Not Found");
    } else {
        $channel = Channel::get_by(url_id: $url_id);
        $renderer->set('channel', $channel);
    }
    
    $renderer->show("chat.tpl.php");
});