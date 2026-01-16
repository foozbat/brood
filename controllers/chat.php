<?php

namespace Brood;

use Fzb\Input;
use Fzb\Renderer;
use Fzb\Htmx;
use function Fzb\Model\gt;
use function Fzb\Model\lt;
use Fzb\JWT; // remove

$renderer = new Renderer();

$router->use_controller_prefix();

/**
 * Gets chat messages.
 */
$router->get(
    "/{url_id}/messages", 
    "/{url_id}/messages/since/{since_id}",
    "/{url_id}/messages/before/{before_id}",
    function () use ($renderer) {
        [$url_id, $since_id, $before_id, $validation] = Input::from_request(
            url_id: 'path required',
            since_id: 'path validate:int',
            before_id: 'path validate:int'
        );

        /*if (!Htmx::is_htmx_request()) {
            return;
        }*/

        $channel = Channel::get_by(url_id: $url_id);

        if (!$channel) {
            Common::flash_message("Channel not found.");
            Htmx::no_content();
            return;
        }

        $pagination = Message::get_pagination_by(
            channel_id: $channel->id,
            _per_page: 10
        );

        $messages = null;

        $params = [
            'channel_id' => $channel->id
        ];

        if ($since_id !== null) {
            $params['id'] = gt($since_id);
        } else if ($before_id !== null) {
            $params['id'] = lt($before_id);
            $params['_limit'] = 10;
        } else {
            Common::debug_message("gothere {$pagination->total_items} {$pagination->total_pages}");
            // paginate and get the last "page"
            $params['_order_by'] = 'id DESC';
            $params['_page'] = $pagination->total_pages;
            $params['_per_page'] = 10;
        }

        $messages = Message::get_by(...$params);

        if (!$before_id && $messages !== null) {
            $newest_message_id = is_array($messages) ? $messages[count($messages) - 1]->id : $messages->id;
            $renderer->set("newest_message_id", $newest_message_id);
        }

        if (!$since_id && $messages !== null) {
            $oldest_message_id = is_array($messages) ? $messages[0]->id : $messages->id;
            $renderer->set("oldest_message_id", $oldest_message_id);
        }

        $renderer->set("messages", $messages);
        $renderer->set("channel_is_empty", $pagination->total_items === 0);
        $renderer->set("url_id", $url_id);

        $renderer->show("fragments/chat_message.tpl.php");
});

/**
 * Send a chat message
 */
$router->post("/{url_id}/send", function () use ($auth, $mercure) {
    $auth->login_required();
    
    [$url_id, $content, $validation] = Input::from_request(
        url_id: 'path required',
        content: 'post required'
    );

    /*

    echo "test response";*/

    if (!Htmx::is_htmx_request()) {
        return;
    }

    $channel = Channel::get_by(url_id: $url_id);

    if (!$channel) {
        Htmx::flash_message("Channel not found.");
        Htmx::no_content();
        return;
    }

    // more validation

    $message = new Message(
        channel_id: $channel->id,
        user_id: $auth->user->id,
        content: $content
    );
    $message->save();

    $mercure->publish("chat:room", "chat-message", "something");
});

/**
 * Event stream for chat room
 */
$router->get("/{url_id}/stream", function () use ($redis, $auth) {
    //ini_set('max_execution_time', 0);

    [$url_id, $validation] = Input::from_request(
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
    [$url_id, $validation] = Input::from_request(
        url_id: 'path required'
    );

    if (!Channel::exists($url_id)) {
        $renderer->set("error", "Channel Not Found");
    } else {
        $channel = Channel::get_by(url_id: $url_id);
        $renderer->set('channel', $channel);
    }

    // change to cookie
    $jwt = JWT::encode(
        payload: [
            'mercure' => [
                'subscribe' => ['chat:room'],
                'exp' => time() + 3600
            ]
        ],
        secret: $_ENV['MERCURE_SUBSCRIBER_JWT_KEY']
    );
    $renderer->set("mercure_url", "/.well-known/mercure?topic=chat:room&authorization={$jwt}");

    $renderer->set('url_id', $url_id);
    $renderer->show("chat.tpl.php");
});