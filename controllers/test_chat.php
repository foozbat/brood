<?php

$renderer = new \Fzb\Renderer();

$router->get("/test_chat", function () use ($renderer) {
    $renderer->set("title", "General Chat");
    $renderer->set("description", "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.");
        
    $renderer->show("test_chat.tpl.php");
});

$router->get("/test_chat/messages", function () use ($renderer) {
    $chats = [];

    for ($i=0; $i<50; $i++) {
        $chats[$i] = [
            'chat_id' => rand(1,1000000),
            'poster' => 'Poster ' . $i, 
            'content' => "Tortor pretium viverra suspendisse potenti nullam. Tortor pretium viverra suspendisse potenti nullam. Tortor pretium viverra suspendisse potenti nullam. Tortor pretium viverra suspendisse potenti nullam."
        ];
    }

    $renderer->set("chats", $chats);
    $renderer->show("fragments/chat_message.tpl.php");
});

$router->route();