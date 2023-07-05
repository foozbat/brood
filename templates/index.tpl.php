<?php 

Fzb\extend("layouts/app_main.tpl.php");
require "components/discussion_post.tpl.php";

$content = function () use ($posts) {
    foreach ($posts as $post) {
        discussion_post($post['poster'], $post['content']);
    }
};