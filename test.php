#!/usr/bin/php
<?php

namespace Brood;

require_once __DIR__."/vendor/autoload.php";

define('ORM_CACHE_DIR', __DIR__ . '/orm_cache');

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
	#[Index]
	public int $another_user_id;

	#[Column(type: Type::INT, unsigned: true, null: false)]
	#[ForeignKey(references: 'users', reference_column: 'id')]
	public int $channel_id;

	#[Column(type: Type::INT, unsigned: true)]
	#[ForeignKey(references: 'threads', reference_column: 'id')]
	public int $thread_id;

	#[Column(type: Type::TEXT)]
	public string $content;

	#[Column(type: Type::INT, unsigned: true, null: false)]
	public int $total_views = 0;

}

class Controller
{
	// Make this class static-only
	private function __construct() { }

	public function test_attrs()
	{
		return "test_attrs";
	}
}

class TestController extends Controller
{
    #[Route]
    public static function test()
    {
        // Example method content
    }
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

Message2::migrate();

//$message = new Message2(user_id: 1, channel_id: 1, thread_id: 1, content: "Hello, world!", total_views: 10);

//var_dump($message);

//echo ":" . $message->save();

echo "Done.\n";
