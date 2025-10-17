<?php
/* 
	file:         index.php
	type:         Main Program
	written by:   Aaron Bishop
	description:  This is the main entry point for the application.
*/

namespace Brood;

use Fzb\Auth, Fzb\Database, Fzb\Router, Fzb\Htmx, Fzb\Benchmark;

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
	print("<pre>");
	print($e);
	print("</pre>");
	exit;
});

//ob_start("ob_gzhandler");

// change to more secure
$db = new Database(
    host: $_ENV['DB_HOST'],
    username: $_ENV['DB_USER'],
    password: $_ENV['DB_PASSWORD'],
    driver: 'mysql',
    database: 'brood'
);

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

    exit();
});

// router using controllers
$router = new Router();
require_once $router->get_controller();
$router->route();