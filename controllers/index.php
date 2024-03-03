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

$router->post("/login", function () use ($auth) {
    $inputs = new Input(
        username: 'post required',
        password: 'post required'
    );

    $success = $auth->login($inputs['username'], $inputs['password']);
    
    if ($success) {
        Htmx::trigger(['user-login-success', 'flash-message' => 'Login success.']);
    } else {
        Htmx::trigger(['user-login-failure', 'flash-message' => 'Login failure!']);
    }
});

$router->get("/logout", function () use ($auth) {
    $auth->logout();
    
    Htmx::trigger(['user-logout', 'flash-message' => 'Logged out.']);
});