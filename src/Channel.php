<?php
namespace Brood;

use Fzb;

class Channel extends Fzb\Model
{
    const __table__ = 'channels';
    public string $title;
    public int $type;
    public string $url_id;
    public ?string $description;

    public static function exists(string $url_id): bool
    {
        return Channel::get_count_by(url_id: $url_id) != 0;
    }
}
