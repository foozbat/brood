<?php

while(true) {
    $msg = fgets(STDIN);
    
    if ($msg) {
        fwrite(STDERR, "RECEIVED $msg" . PHP_EOL);

        $message = json_decode($msg);

        # fwrite(STDERR, print_r($_SERVER, true) . PHP_EOL);

        $renderer = new \Fzb\Renderer();
        $renderer->set("chat_message", $message->chat_message);
        $response = $renderer->render_as_string('test/chat_response.tpl.php');
        $response = str_replace("\n", "", $response);
 
        # fwrite(STDERR, "SENDING $response" . PHP_EOL);
        
        echo $response."\n";
    }
}