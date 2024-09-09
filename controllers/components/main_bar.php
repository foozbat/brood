<?php

namespace Megaboard;

use Fzb\Input, Fzb\Renderer;

$renderer = new Renderer();

$router->get("/components/main_bar", function () use ($renderer) {
    $renderer->set('forum_index', [
        "Welcome" => [
            ["Announcements", "/announcements", "pin", 3],
            ["Community Rules", "/rules", "pin", 0]
        ],
        "General Discussion" => [
            ["General Chat", "/test_chat", "chat", 0],
            ["Programming", "/test_forum", "forum", 323],
            ["Login Required", "/login_required", "forum", 123],
            ["Web Development", "/test_forum", "forum", "2.1K"],
            ["API Design Super Long API Name That is so Long", "/test_forum", "forum", 21]
        ],
        "More Groups" => [
            ["Interesting Chat", "/test_chat", "chat", 0],
            ["Uniteresting Chat", "/test_chat", "chat", 0],
            ["Meme Links", "/test_links", "links", 0],
            ["Streaming Cat Videos", "/test_video", "video", "LIVE"],
        ],
        "More More Groups" => [
            ["More Interesting Links", "/test_links", "links", 0],
            ["More Uniteresting Links", "/test_links", "links", 0],
            ["More Meme Contest", "/test_chat", "chat", 0],
            ["More Streaming Cat Videos", "/test_video", "video", "LIVE"],
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