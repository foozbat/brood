#!/usr/bin/php
<?php

namespace Brood;

require_once __DIR__."/vendor/autoload.php";

//define('ORM_CACHE_DIR', __DIR__ . '/orm_cache');

use Fzb\Database;
use Fzb\Model\Base;
use Fzb\Model\Table;
use Fzb\Model\Column;
use Fzb\Model\Type;
use Fzb\Model\Index;
use Fzb\Model\ForeignKey;
use Fzb\Model\ReferentialAction;

#[Table('messages2')]
#[Something]
class Message2 extends Base
{
	#[Column(type: Type::INT, unsigned: true, null: false)]
	#[Index]
	public int $user_id;

	#[Column(type: Type::INT, unsigned: true, null: false)]
	#[ForeignKey(references: 'channels', reference_column: 'id')]
	public int $channel_id;

	#[Column(type: Type::INT, unsigned: true)]
	#[ForeignKey(references: 'threads', reference_column: 'id', on_delete: ReferentialAction::CASCADE)]
	public int $thread_id;

	#[Column(type: Type::TEXT)]
	public string $content;

	#[Column(type: Type::INT, unsigned: true, null: false)]
	public int $total_views = 0;

}

$db = new Database(
    host: $_ENV['DB_HOST'],
    username: $_ENV['DB_USER'],
    password: $_ENV['DB_PASSWORD'],
    driver: 'mysql',
    database: 'brood'
);

echo "Testing...\n";

// get all attributes with reflection

$messages = new Message2();

Message2::migrate();

echo "Done.\n";

?>