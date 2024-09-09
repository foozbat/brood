<?php
namespace Brood;

use Fzb\Input, Fzb\Renderer, Fzb\Htmx;

$renderer = new \Fzb\Renderer();

$router->use_controller_prefix();

$router->add(
    ['GET', 'POST'],
    '/new', 
    function () use ($renderer, $router) {
        
        if (false) {
            Common::flash_message(message: 'Invalid parameters', type: 'failure');
            
            // if success
                Htmx::redirect("/thread/$thread_id");
        } else {
            //
        }
        $renderer->show('fragments/thread_new.tpl.php');
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
        
        $thread = Thread::get_by(url_id: $url_id);

        if (!$thread) {
            $renderer->set('thread_not_found', true);
        } else {
            $messages = Message::get_by(
                thread_id: $thread->id,
                _page: $page,
                _per_page: 10, // change
            );

            $renderer->set('thread', $thread);
            $renderer->set('messages', $messages);
        }

        $renderer->show('thread.tpl.php');
    }
);


