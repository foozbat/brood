<?php

namespace Brood;

use Fzb;
use Fzb\Model\Table;
use Fzb\Model\Column;
use Fzb\Model\Type;

#[Table('users')]
class User extends Fzb\User
{
    #[Column(type: Type::VARCHAR, length: 255)]
    public string $display_name;
}