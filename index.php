<?php
/* 
	file:         index.php
	type:         Main Program
	written by:   Aaron Bishop
	description:  This is the main entry point for the application.
*/

namespace Brood;

use Fzb;

if (!preg_match('/^8\.1/i', phpversion())) {
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
$db = new Fzb\Database(
    username: 'brood',
    password: 'password',
    driver: 'mysql',
    host: 'localhost',
    database: 'brood'
);

$auth = new Fzb\Auth(User::class);

// router using controllers
$router = new Fzb\Router();
require_once $router->get_controller();
$router->route();