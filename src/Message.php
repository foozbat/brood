<?php
namespace Brood;

use Fzb;

class Message extends Fzb\Model
{
    const __table__ = 'messages';
    
    public int $user_id;
    public int $channel_id;
    public ?int $thread_id;
    public string $content;
    public int $total_views;


}