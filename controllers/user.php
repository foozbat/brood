<?php

namespace Brood;

use Fzb\Input, Fzb\Renderer;

$auth->on_failure(function () {
    echo "auth failure";
    die();
});

$router->get('/user/events', function () {

});

$router->get('/user/create', function () {
    $user = new User(
        username: 'user'.rand(0, 1000),
        password: 'test',
        my_field: 'blah'
    );

    var_dump($user);
    
    $user->save();

    var_dump($user);
});

$router->get('/user/{user_id}/change_password', function () {
    $inputs = new Input(user_id: 'path');

    $user = User::get_by(id: $inputs['user_id']);

    if ($user === null) {
        echo "user not found";
        return;
    }

    var_dump($user);

    if (!$user->change_password('test', 'newpass')) {
        echo "could not change password";
        return;
    }

    $user->save();

    var_dump($user);
});

$router->get('/user/all', function () {
    /*$users = User::get_by(
        id: 6,
        _page: 1,
        _per_page: 5,
        _order_by: [
            'username', 
            'created_at' => 'DESC'
        ]
    );*/

    $users = User::from_sql(
        "SELECT * FROM users WHERE id IN(?,?,?)", 6, 15, 17, 
        _page: 1,
        _per_page: 5,
        _order_by: [
            'username', 
            'created_at' => 'DESC'
        ]
    );

    if ($users !== null) {
        foreach ($users as $user) {
            var_dump($user);
        }
    }
});

$router->get('/user/{user_id}/profile', function () use ($auth) {
    $inputs = new Input(user_id: 'path');

    $user = User::get_by(id: $inputs['user_id']);

    $renderer = new Renderer();
    $renderer->set('user', $user);
    $renderer->show("user/profile.tpl.php");
});

$router->get('/count', function () {
    echo User::get_count();
});

$router->get('/login', function () use ($auth) {
    $auth->login('test', 'test');

    var_dump($auth->user);
    var_dump($auth->user_session);
});

$router->get('/test_login_required', function () use ($auth) {
    $auth->login_required();

    echo "success";
});

$router->get('/test_csrf_required', function () use ($auth) {
    $auth->csrf_required();

    echo "success";
});

