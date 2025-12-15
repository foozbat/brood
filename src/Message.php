<?php
namespace Brood;

use Fzb\Model\Base;
use Fzb\Model\Table;
use Fzb\Model\Column;
use Fzb\Model\Type;

#[Table('messages')]
class Message extends Base
{
    #[Column(type: Type::INT, unsigned: true)]
    public int $user_id;

    #[Column(type: Type::INT, unsigned: true)]
    public int $channel_id;

    #[Column(type: Type::INT, unsigned: true)]
    public ?int $thread_id;

    #[Column(type: Type::TEXT)]
    public string $content;

    #[Column(type: Type::INT, unsigned: true, default: 0)]
    public int $total_views;

    public ?User $user;

    public static function get_by(mixed ...$params): mixed
    {
        if (isset($params['_user_data']) && $params['_user_data'] === true) {
            $params['_left_join'] = [User::class => ['user_id', 'id', 'user']];
            unset($params['_user_data']);
        }
        
        return parent::get_by(...$params);
    }
}