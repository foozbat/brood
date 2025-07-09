<?php

namespace Brood;

use Fzb\Input, Fzb\Renderer;

$renderer = new Renderer();

$router->get("/components/user_bar", function () use ($renderer) {
    $renderer->set('users', [
        'Jean Luc Picard', 'Deanna Troi', 'Data', 'Will Riker', 'Beverly Crusher',
        'Jean Luc Picard', 'Deanna Troi', 'Data', 'Will Riker', 'Beverly Crusher',
        'Jean Luc Picard', 'Deanna Troi', 'Data', 'Will Riker', 'Beverly Crusher',
        'Jean Luc Picard', 'Deanna Troi', 'Data', 'Will Riker', 'Beverly Crusher the Ship Doctor',
        'Jean Luc Picard', 'Deanna Troi', 'Data', 'Will Riker', 'Beverly Crusher',
        'Jean Luc Picard', 'Deanna Troi', 'Data', 'Will Riker', 'Beverly Crusher',
        'Jean Luc Picard', 'Deanna Troi', 'Data', 'Will Riker', 'Beverly Crusher',
        'Jean Luc Picard', 'Deanna Troi', 'Data', 'Will Riker', 'Beverly Crusher',
        'Jean Luc Picard', 'Deanna Troi', 'Data', 'Will Riker', 'Beverly Crusher',
        'Jean Luc Picard', 'Deanna Troi', 'Data', 'Will Riker', 'Beverly Crusher'
    ]);

    $renderer->show('components/user_bar.tpl.php');
});