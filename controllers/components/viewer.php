<?php

use Fzb\Input, Fzb\Renderer;

$router->get("/components/viewer/", function () {
    $input = new Input(element: 'get');
    $renderer = new Renderer();
    
    $renderer->set("element", $input['element']);
    $renderer->show("components/viewer.tpl.php");
});

$router->route();