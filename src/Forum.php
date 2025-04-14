<?php
namespace Brood;

use Fzb;

class Forum extends Channel
{
    public Thread|array $threads;

    public static function get_by(...$params): mixed
    {
        $forum = parent::get_by(...$params);

        if (!$forum) {
            return null;
        }
    
        $forum->threads = Thread::get_by(
            channel_id: $forum->id,
            _order_by: [ "created_at" => "DESC" ]
        );

        return $forum;
    }
}