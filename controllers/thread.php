<?php
namespace Brood;

use Fzb\Input, Fzb\Renderer, Fzb\Htmx;

$renderer = new \Fzb\Renderer();

$router->use_controller_prefix();

$router->add(
    ['GET', 'POST'],
    '/new/{channel_id}', 
    function () use ($renderer, $router, $auth) {
        if ($router->is_post()) {
            $auth->login_required();
            
            list($channel_id, $title, $content, $validation) = Input::from_request(
                channel_id: 'path required validate:int',
                title: 'post required',
                content: 'post required'
            );

            if ($validation->is_missing()) {
                Common::flash_message(message: 'Required fields missing.', type: 'failure');
                Htmx::trigger('missing-values');
            }

            // check if channel exists

            // check if user authorized to post in channel

            // more checks
            
            $thread = new Thread(
                channel_id: $channel_id,
                user_id: $auth->user->id, 
                title: $title
            );
            $thread->save();

            $message = new Message(
                thread_id: $thread->id, 
                channel_id: $channel_id,
                user_id: $auth->user->id,
                content: $content
            );
            $message->save();

            // success
            Htmx::location([
                'path' => "/thread/$thread->url_id",
                'target' => '#'.Htmx::target_id()
            ]);
            Htmx::no_content();
            return;
        }
        
        list($channel_id, $validation) = Input::from_request(
            channel_id: 'path validate:int required'
        );

        $renderer->set('channel_id', $channel_id);
        $renderer->show('components/modals/thread_new.tpl.php');
    }
);


/**
 * Displays a specified thread
 */
$router->get(
    '/{url_id}/{page}',
    '/{url_id}',
    function () use ($renderer) {
        list($url_id, $page, $validation) = Input::from_request(
            url_id: 'path required',
            page:   'path validate:int default:1'
        );

        if ($validation->is_missing() || $validation->is_invalid()) {
            Common::flash_message(message: 'Invalid parameters', type: 'failure');
            Common::no_content();
            return;
        }
        
        $thread = Thread::get_content(
            url_id: $url_id,
            _page: $page,
            _per_page: 10, // change
        );

        $renderer->set('thread', $thread);

        $renderer->show('thread.tpl.php');
    }
);


