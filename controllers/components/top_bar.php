<?php

namespace Brood;

use Fzb\Renderer;

$renderer = new Renderer();

$router->get('/components/top_bar', function () use ($renderer) {
    $renderer->show('components/top_bar.tpl.php');
});
