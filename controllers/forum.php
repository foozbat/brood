<?php
namespace Brood;

use Fzb\Input, Fzb\Renderer;

$renderer = new Renderer();

$router->use_controller_prefix();

$router->get('/', function () use ($renderer) {
    echo "blah";
});

$router->get('/new', function () use ($renderer) {
    echo "new";
});

$router->get('/{url_id}', function () use ($renderer) {
    list($url_id, $validation) = Input::from_request(url_id: 'required path');

    /*$channel = Channel::get_by(url_id: $url_id);

    if (!$channel) {
        Common::flash_message('Channel not found.', 'failure');
        Common::no_content();
        return;
    }

    $threads = Thread::get_by(channel_id: $channel->id);*/

    $forum = Forum::get_by(
        url_id: $url_id,
    );

    if (!$forum) {
        Common::flash_message('Forum not found.', 'failure');
        Common::no_content();
        return;
    }

    $renderer->set('forum', $forum);
    //$renderer->set('threads', $threads);

    $renderer->show("forum.tpl.php");
});
