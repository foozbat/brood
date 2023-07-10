<?php

$renderer = new \Fzb\Renderer();

$posts = [];

for ($i=0; $i<rand(1,25); $i++) {
    $posts[$i] = [
        'poster' => 'Poster ' . $i, 
        'content' => "Tortor pretium viverra suspendisse potenti nullam. A arcu cursus vitae congue mauris rhoncus aenean vel elit. Enim facilisis gravida neque convallis. Tellus cras adipiscing enim eu. Sed risus ultricies tristique nulla aliquet. Arcu cursus vitae congue mauris rhoncus. Id venenatis a condimentum vitae sapien. In nibh mauris cursus mattis molestie a iaculis. Facilisis leo vel fringilla est ullamcorper eget nulla facilisi etiam. Arcu cursus euismod quis viverra. Arcu cursus euismod quis viverra. Erat pellentesque adipiscing commodo elit. Ac odio tempor orci dapibus ultrices in iaculis nunc.
        <p>
        Viverra justo nec ultrices dui sapien eget mi proin. Pulvinar mattis nunc sed blandit libero volutpat sed. Ipsum faucibus vitae aliquet nec. Nunc congue nisi vitae suscipit tellus mauris a diam. Semper quis lectus nulla at volutpat diam ut venenatis tellus. Facilisis mauris sit amet massa vitae tortor. Ornare aenean euismod elementum nisi quis eleifend quam adipiscing vitae. Odio eu feugiat pretium nibh. Morbi tincidunt augue interdum velit euismod in pellentesque massa placerat. Ac felis donec et odio pellentesque diam volutpat commodo. Nibh sed pulvinar proin gravida hendrerit lectus. Morbi tincidunt augue interdum velit. Scelerisque viverra mauris in aliquam sem. Fermentum et sollicitudin ac orci phasellus egestas."
    ];
}

$renderer->set('title', 'Test Thread');
$renderer->set('forum_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tortor pretium viverra suspendisse potenti nullam. A arcu cursus vitae congue mauris rhoncus aenean vel elit. Enim facilisis gravida neque convallis');
$renderer->set('posts', $posts);

$renderer->show("test_thread.tpl.php");