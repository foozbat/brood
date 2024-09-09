<?php
/*
   //
*/

define('APP_NAME', 'brood');

define('APP_DIR', __DIR__);
define('DEFAULT_CONTROLLER', 'index.php');
define('CONTROLLERS_DIR', __DIR__.'/controllers');
define('TEMPLATES_DIR',   __DIR__.'/templates');
define('CONFIG_DIR',      __DIR__.'/config');
define('DATA_DIR',        __DIR__.'/data');

define('CHANNEL_TYPE', array(
   'ANNOUNCEMENTS' => 0,
   'FORUM' => 1,
   'CHAT' => 2,
   'VIDEO' => 3,
   'LINKS' => 4
));
