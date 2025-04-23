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

    public ?User $user;

    public static function get_by(mixed ...$params): mixed
    {
        if ($params['_user_data']) {
            $params['_left_join'] = [User::class => ['user_id', 'id', 'user']];
            unset($params['_user_data']);
        }
        
        return parent::get_by(...$params);
    }
}