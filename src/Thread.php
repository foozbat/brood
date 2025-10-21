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

    public Message|array|null $messages;

    public function save(): bool
    {
        if (!isset($this->url_id)) {
            $temp_url_id = strtolower($this->title);
            $temp_url_id = preg_replace('/\s+/', '-', $temp_url_id);
            $temp_url_id = preg_replace('/[^a-z0-9\-]/', '', $temp_url_id);
            $temp_url_id = trim($temp_url_id, '-');

            $url_id_matches = Thread::get_count_by(url_id: $temp_url_id);

            var_dump($url_id_matches);

            if ($url_id_matches > 0) {
                $temp_url_id .= '-'.$url_id_matches+1;
            }

            $this->url_id = $temp_url_id;
        }
        return parent::save();
    }

    public static function get_content(...$params): ?Thread
    {
        $thread = parent::get_by(url_id: $params['url_id']);
        //unset($params['url_id']);

        if (!$thread) {
            return null;
        }

        $thread->messages = Message::get_by(
            thread_id: $thread->id,
            _user_data: true
        );

        //var_dump($thread);

        return $thread;
    } 
}