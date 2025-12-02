<?php declare(strict_types=1);

define('ORM_CACHE_DIR', __DIR__ . '/orm_cache');

$loader = require_once __DIR__."/vendor/autoload.php";

use Fzb\Database;
use Fzb\Model\Migration;

$db = new Database(
    host: $_ENV['DB_HOST'],
    username: $_ENV['DB_USER'],
    password: $_ENV['DB_PASSWORD'],
    driver: 'mysql',
    database: 'brood'
);

$composer_json = json_decode(file_get_contents(__DIR__ . '/composer.json'), true);

$paths = $composer_json['autoload']['psr-4'] ?? [];

foreach ($paths as $namespace => $path) {
    foreach ($path as $p) {
        echo "Namespace: $namespace | Path: $p\n";

        $p = __DIR__ . '/' . $p;

        foreach (glob($p . '*.php') as $filename) {
            include $filename;
        }

        echo($namespace . "\n");

        $classes = array_filter(get_declared_classes(), function ($class) use ($namespace) {
            return str_starts_with($class, $namespace);
        });

        print_r($classes);

        foreach ($classes as $class) {
            echo "Processing class: $class\n";

            if (method_exists($class, 'migrate')) {
                $class::migrate();
            }
        }
    }
}



