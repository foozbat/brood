<?php

namespace Megaboard;

use Fzb\Input, Fzb\Renderer;

$renderer = new Renderer();

$router->get("/components/main_bar", function () use ($renderer) {
    $renderer->set('forum_index', [
        "Welcome" => [
            ["Announcements", "pin", 3],
            ["Community Rules", "pin", 0]
        ],
        "General Discussion" => [
            ["General Chat", "chat", 0],
            ["Programming", "forum", 323],
            ["Graphic Design", "forum", 123],
            ["Web Development", "forum", "2.1K"],
            ["API Design", "forum", 21]
        ],
        "More Discussion" => [
            ["Interesting Chat", "chat", 0],
            ["Uniteresting Chat", "chat", 0],
            ["Meme Contest", "chat", 0],
            ["Streaming Cat Videos", "video", "LIVE"],
        ]
    ]);

    $renderer->show('components/main_bar.tpl.php');
});

$router->route();