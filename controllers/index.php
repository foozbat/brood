<?php

$router->get('/', function () {
    $renderer = new \Fzb\Renderer();
    $renderer->set('title', 'Main');
    $renderer->show('index.tpl.php');
});

$router->get("/login", function () use ($auth) {
    echo "did login? " . $auth->login('test', 'test') . "<br />";
    
    // change
    header("Location: /");
});

$router->get("/logout", function () use ($auth) {
    $auth->logout();
    
    // change
    header("Location: /");
});

//var_dump($router);

$router->route();