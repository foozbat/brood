<?php
namespace Brood;

use Fzb;

class Thread extends Fzb\Model
{
    const __table__ = 'threads';

    public int $user_id;
    public int $channel_id;
    public string $title;
    public string $url_id;
    public int $total_messages;
    public int $total_views;
}