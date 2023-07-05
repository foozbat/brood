<?php

use Fzb\Input, Fzb\Renderer;

$router->get("/components/viewer/{component}", function () {
    $input = new Input(component: 'path');
    $renderer = new Renderer();
    
    $renderer->set("component", $input['component']);
    $renderer->show("components/viewer.tpl.php");
});

$router->route();