<?php

use Fzb\Htmx, Fzb\HtmxSwap;

$auth->login_required();

$renderer = new \Fzb\Renderer();

$threads = [];

for ($i=0; $i<rand(1,25); $i++) {
    $threads[$i] = [
        'poster' => 'Poster ' . $i, 
        'title' => "Secret! Tortor pretium viverra suspendisse potenti nullam"
    ];
}

$renderer->set('title', 'Programming');
$renderer->set('forum_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tortor pretium viverra suspendisse potenti nullam. A arcu cursus vitae congue mauris rhoncus aenean vel elit. Enim facilisis gravida neque convallis');
$renderer->set('threads', $threads);

$renderer->show("test_forum.tpl.php");