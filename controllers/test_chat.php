<?php

$renderer = new \Fzb\Renderer();

$router->get("/test_chat", function () use ($renderer) {
    $renderer->set("title", "General Chatroom");
    $renderer->set("description", "This is a description block for the chat room. It lets the users know what the topic of the chat room is, and perhaps rules if they so choose.");
        
    $renderer->show("test_chat.tpl.php");
});

$router->get(
    "/test_chat/messages", 
    "/test_chat/messages/{num}",
    function () use ($renderer) {
        $inputs = new \Fzb\Input(
            num: "path validate:int default:25"
        );

        $chats = [];

        for ($i=0; $i<(int) (string) $inputs['num']; $i++) {
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