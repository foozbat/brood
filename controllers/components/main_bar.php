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
            ["API Design Super Long API Name That is so Long", "forum", 21]
        ],
        "More Groups" => [
            ["Interesting Chat", "chat", 0],
            ["Uniteresting Chat", "chat", 0],
            ["Meme Links", "links", 0],
            ["Streaming Cat Videos", "video", "LIVE"],
        ],
        "More More Groups" => [
            ["More Interesting Links", "links", 0],
            ["More Uniteresting Links", "links", 0],
            ["More Meme Contest", "chat", 0],
            ["More Streaming Cat Videos", "video", "LIVE"],
        ]
    ]);

    $renderer->set('dm_users', [
        1 => [
            "user_id" => 1,
            "username" => "Billy",
            "unread" => 2,
        ],
        2 => [
            "user_id" => 2,
            "username" => "Steve-O",
            "unread" => 5,
        ],
        3 => [
            "user_id" => 3,
            "username" => "Frank",
            "unread" => 0,
        ],
        4 => [
            "user_id" => 4,
            "username" => "Suzy",
            "unread" => 103,
        ]
    ]);

    $renderer->show('components/main_bar.tpl.php');
});

$router->route();