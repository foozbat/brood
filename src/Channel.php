<?php
namespace Brood;

use Fzb;

use Fzb\Model\Base;
use Fzb\Model\Table;
use Fzb\Model\Column;
use Fzb\Model\Type;

#[Table('channels')]
class Channel extends Base
{
    #[Column(type: Type::VARCHAR, length: 255)]
    public string $title;

    #[Column(type: Type::INT)]
    public int $type;

    #[Column(type: Type::VARCHAR, length: 255)]
    public string $url_id;

    #[Column(type: Type::TEXT)]
    public ?string $description;

    public static function exists(string $url_id): bool
    {
        return self::get_count_by(url_id: $url_id) != 0;
    }
}
