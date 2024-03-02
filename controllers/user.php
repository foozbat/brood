<?php

namespace Brood;

use Fzb;

$auth->on_failure(function () {
    echo "auth failure";
    die();
});

$router->use_controller_prefix();

$router->get('/events', function () {

});

$router->get('/profile', function () use ($auth) {
    $auth->login_required();

    $renderer = new Fzb\Renderer();
    $renderer->set('user', $auth->user);
    $renderer->show("user/profile.tpl.php");
});

$router->get('/test', function () use ($auth) {
    $auth->login('test', 'test');
});

$router->get('/test_login_required', function () use ($auth) {
    $auth->login_required();

    echo "success";
});

$router->get('/test_csrf_required', function () use ($auth) {
    $auth->csrf_required();

    echo "success";
});