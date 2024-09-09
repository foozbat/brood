<?php
namespace Brood;

use Fzb;

class Channel extends Fzb\Model
{
    const __table__ = 'channels';
    public string $title;
    public ?string $description;
    public int $type;
}