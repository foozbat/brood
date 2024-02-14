<?php

$renderer = new \Fzb\Renderer();

$router->use_controller_prefix();

$router->get("/", function () use ($renderer) {
    $renderer->set("title", "General Chatroom");
    $renderer->set("description", "This is a description block for the chat room. It lets the users know what the topic of the chat room is, and perhaps rules if they so choose.");
        
    $renderer->show("test_chat.tpl.php");
});

$router->get(
    "/messages", 
    "/messages/{num}",
    function () use ($renderer) {
        $inputs = new \Fzb\Input(
            num: "path validate:int default:25"
        );

        $lorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Posuere lorem ipsum dolor sit amet consectetur adipiscing elit. Enim facilisis gravida neque convallis a cras semper auctor neque. Vel eros donec ac odio tempor orci. Donec pretium vulputate sapien nec sagittis aliquam malesuada. Vitae suscipit tellus mauris a diam. Vitae semper quis lectus nulla at volutpat diam. Scelerisque varius morbi enim nunc faucibus a pellentesque. At urna condimentum mattis pellentesque id nibh tortor id aliquet. Suspendisse faucibus interdum posuere lorem ipsum dolor sit. In hac habitasse platea dictumst quisque sagittis purus sit amet. Porttitor lacus luctus accumsan tortor posuere ac ut consequat. Maecenas accumsan lacus vel facilisis volutpat est velit. Pharetra vel turpis nunc eget. Auctor augue mauris augue neque gravida. Nunc mattis enim ut tellus. Ipsum a arcu cursus vitae congue mauris rhoncus aenean.";
        $lorems = explode(". ", $lorem);

        $chats = [];

        for ($i=0; $i<(int) (string) $inputs['num']; $i++) {
            $chats[$i] = [
                'chat_id' => rand(1,1000000),
                'poster' => 'Poster ' . $i, 
                'content' => join(". ", array_slice($lorems, rand(0,5), rand(1,6)))
            ];
        }

        $renderer->set("chats", $chats);
        $renderer->show("fragments/chat_message.tpl.php");
});

$router->post("/send", function () {
    $pub = new Redis();
    $pub->connect('127.0.0.1');
    $pub->publish('chat', 'chat-message');
});

$router->route();