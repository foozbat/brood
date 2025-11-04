<?php declare(strict_types=1);
/*  
	file:         index.php
	type:         Main Program
	written by:   Aaron Bishop
	description:  This is the main entry point for the application.
*/

namespace Brood;

use Fzb\Auth, Fzb\Database, Fzb\Router, Fzb\Htmx, Fzb\Benchmark, \Redis;

// Prevent worker script termination when a client connection is interrupted
ignore_user_abort(true);

if (!preg_match('/^8\.*/i', phpversion())) {
	die("brood requires PHP version 8.1 or newer.");
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// app specific initialization
require_once __DIR__."/init.php";

// Boot your app
require __DIR__.'/vendor/autoload.php';

// Handler outside the loop for better performance (doing less work)
$handler = static function () {
    try {
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

        // router using controllers
        $router = new Router();
        require_once $router->get_controller();
        $router->route();        
        // end brood boilerplate
    } catch (\Throwable $exception) {
        // `set_exception_handler` is called only when the worker script ends,
        // which may not be what you expect, so catch and handle exceptions here
        if (Htmx::is_htmx_request()) {
            Common::debug_message($exception->getMessage()."\n".$exception->getTraceAsString());
        } else {
            echo "<h1>Application Error</h1>";
            echo "<pre>".$exception->getMessage()."\n\n";
            echo $exception->getTraceAsString();
            echo "</pre>";
        }

        exit;
    }
};

$maxRequests = (int)($_SERVER['MAX_REQUESTS'] ?? 0);
for ($nbRequests = 0; !$maxRequests || $nbRequests < $maxRequests; ++$nbRequests) {
    $keepRunning = \frankenphp_handle_request($handler);

    // Do something after sending the HTTP response

    // Call the garbage collector to reduce the chances of it being triggered in the middle of a page generation
    gc_collect_cycles();

    if (!$keepRunning) break;
}

// Cleanup code here (if any)