<?php

namespace Brood;

use Fzb\Database2;

/*$sql = "
    SELECT ".Thread::get_sql_fields().", COUNT(messages.id) as total_messages2
    FROM ".Thread::__table__."
    LEFT JOIN messages on threads.id = messages.thread_id
    GROUP BY threads.id
";

echo "THREAD LIST";

$threads = Thread::from_sql(
    query: $sql,
    _page: 1,
    _per_page: 20
);

foreach ($threads as $thread) {
    [$thread_info, $message_count] = $thread;

    var_dump($thread_info);
    var_dump($message_count);
}*/

//var_dump($threads);

/*echo "THREAD";

$rslt = Thread::get_by(
    channel_id: 1,
    _order_by: [ "created_at" => "DESC" ],
    _left_join: [User::class => ['user_id', 'id', 'user']],
    _page: 1,
    _per_page: 5
);

//var_dump($rslt);

$rslt = Message::get_by(
    thread_id: 1,
    _left_join: [User::class => ['user_id', 'id', 'user']],
);

var_dump($rslt);

//$totp = new TOTP('JBSWY3DPEHPK3PXP');
//echo 'Current TOTP uode: ' . $totp->get_code();

*/

$test_db = new Database2(
    username: 'brood',
    password: 'password',
    driver: 'mysql',
    host: 'localhost',
    database: 'brood'
);

$sth = $db->