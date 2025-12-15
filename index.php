<?php
/* 
	file:         index.php
	type:         Main Program
	written by:   Aaron Bishop
	description:  This is the main entry point for the application.
*/

namespace Brood;

use Fzb\Auth, Fzb\Database, Fzb\Router, Fzb\Htmx, Fzb\Benchmark, Fzb\JWT, Fzb\Mercure, \Redis;

if (!preg_match('/^8\.*/i', phpversion())) {
	die("brood requires PHP version 8.1 or newer.");
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// app specific initialization
require_once __DIR__."/init.php";

// class autoloader
require_once __DIR__."/vendor/autoload.php";

set_exception_handler(function ($e) {
    if (Htmx::is_htmx_request()) {
	    Common::debug_message($e->getMessage()."\n".$e->getTraceAsString());
    } else {
        echo "<h1>Application Error</h1>";
        echo "<pre>".$e->getMessage()."\n\n";
        echo $e->getTraceAsString();
        echo "</pre>";
    }

	exit;
});

//ob_start("ob_gzhandler");

// create database connection
$db = new Database(
    host: $_ENV['DB_HOST'],
    username: $_ENV['DB_USER'],
    password: $_ENV['DB_PASSWORD'],
    driver: 'mysql',
    database: 'brood'
);

// create Redis connection
$redis = new Redis();
$redis->connect($_ENV['REDIS_HOST'], $_ENV['REDIS_PORT']);

// authenticate user
$auth = new Auth(User::class);
$auth->on_failure(function (string $next_url) {
    if (Htmx::is_htmx_request()) {
        Htmx::trigger([
            'show-login-modal' => [
				'next_url' => $next_url
			]
        ]);
        Htmx::no_content();
    } else {
        header("Location: /");
    }

    exit;
});

// Create Mercure publisher
error_log("Creating Mercure publisher...");
$jwt =  JWT::encode(
    payload: [
        'mercure' => [
            'publish' => ['*'],
            'exp' => time() + 3600
        ]
        ],
    secret: $_ENV['MERCURE_PUBLISHER_JWT_KEY']
);
$mercure = new Mercure('http://mercure', $jwt);

// router using controllers
$router = new Router();
require_once $router->get_controller();
$router->route();