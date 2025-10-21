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
}
