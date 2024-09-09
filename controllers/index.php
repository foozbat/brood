<?php

use Fzb\Input, Fzb\Renderer, Fzb\Htmx;

$router->get('/', function () {
    $renderer = new Renderer();
    $renderer->set('title', 'Main');
    $renderer->show('index.tpl.php');
});

$router->get('/test_login', function () use ($auth) {
    $auth->login('test', 'test');

});

$router->add(
    ['GET', 'POST'],
    "/login", 
    function () use ($auth) {
        $inputs = new Input(
            username: 'post required',
            password: 'post required',
            next_url: 'post'
        );

        if ($inputs->is_post()) {
            $success = $auth->login($inputs['username'], $inputs['password']);
            
            if ($success) {
                Htmx::trigger([
                    'user-login-success', 
                    'flash-message' => [
                        'type' => 'success',
                        'message' => 'Login success.'
                    ]
                ]);

                if ($inputs['next_url']) {
                    Htmx::location([
                        'path' => (string) $inputs['next_url'],
                        'target' => '#content_area'
                    ]);
                }
            } else {
                Htmx::trigger([
                    'user-login-failure', 
                    'flash-message-login' => [
                        'type' => 'failure', 
                        'message' =>'Login failed: Invalid username or password.'
                    ]
                ]);
            }

            Htmx::no_content();
        } else {
            $renderer = new Renderer();
            $renderer->show('components/modals/login.tpl.php');
        }
    }
);

$router->get("/logout", function () use ($auth) {
    $auth->logout();
    
    Htmx::trigger([
        'user-logout', 
        'flash-message' => [
            'type' => 'success',
            'message' => 'Logged out.'
        ]
    ]);
    
    Htmx::location([
        'path' => '/',
        'target' => '#content_area'
    ]);

    Htmx::no_content();
});