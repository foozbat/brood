<?php
/* 
	file:         index.php
	type:         Main Program
	written by:   Aaron Bishop
	description:  This is the main entry point for the application.
*/

if (!preg_match('/^8\.1/i', phpversion())) {
	die("Fzb Framework requires PHP version 8.1 or newer.");
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

// router using controllers
$router = new Fzb\Router();
require_once $router->get_controller();
