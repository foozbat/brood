<?php

$renderer = new \Fzb\Renderer();

$posts = [];

for ($i=0; $i<rand(1,25); $i++) {
    $posts[$i] = [
        'poster' => 'Poster ' . $i, 
        'content' => "Tortor pretium viverra suspendisse potenti nullam. A arcu cursus vitae congue mauris rhoncus aenean vel elit. Enim facilisis gravida neque convallis. Tellus cras adipiscing enim eu. Sed risus ultricies tristique nulla aliquet. Arcu cursus vitae congue mauris rhoncus. Id venenatis a condimentum vitae sapien. In nibh mauris cursus mattis molestie a iaculis. Facilisis leo vel fringilla est ullamcorper eget nulla facilisi etiam. Arcu cursus euismod quis viverra. Arcu cursus euismod quis viverra. Erat pellentesque adipiscing commodo elit. Ac odio tempor orci dapibus ultrices in iaculis nunc.

<unsafe tag>

[b]bold[/b] [B]BOLD[/B] [i]italic[/i] [I]ITALIC[/I]
[u]underline[/u] [U]UNDERLINE[/U] [s]strike[/s] [S]STRIKE[/S]
[size=64]font size[/size]

List
[list]
[*]one
[*]two
[*]three

[*]space before me
[/list]

something

[quote]
This is a quoted
block
of text
[/quote]

Some Text
[quote=Someguy]This is quoted. <script language='text/javascript'>alert('hello')</script>[/quote]
Some more text.

[code]
int main() {
    return 0;
}
[/code]

[size=64]😀[/size]
"
    ];
}

$renderer->set('title', 'Test Thread');
$renderer->set('forum_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tortor pretium viverra suspendisse potenti nullam. A arcu cursus vitae congue mauris rhoncus aenean vel elit. Enim facilisis gravida neque convallis');
$renderer->set('posts', $posts);

// artificial slowness
sleep(1);

$renderer->show("test_thread.tpl.php");