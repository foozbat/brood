<?php

namespace Brood;

use Fzb\Htmx;

class Common {
    static function flash_message(string $message, string $type = 'info', string $name = '')
    {
        Htmx::trigger([
            'flash-message' => [
                'type' => $type,
                'message' => $message
            ]
        ]);
    }

    static function debug_message(string $message)
    {
        Htmx::trigger([
            'debug-message' => [
                'message' => $message
            ]
        ]);
    }

    static function no_content()
    {
        Htmx::no_content();
    }
}