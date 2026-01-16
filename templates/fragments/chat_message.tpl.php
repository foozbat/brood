<?php
/**
 * Chat messages block fragment
 */

require_once "components/user_icon.tpl.php";

use Fzb\Date;

?>

<?php
/**
 * Old message getter is oob swapped into parent to update $oldest_message_id
 */
if ($oldest_message_id): ?>
    <div
        id="old_message_getter"
        hx-get="/chat/<?= $url_id ?>/messages/before/<?= $oldest_message_id ?>"
        hx-trigger="intersect"
        hx-target="#chat_messages"
        hx-swap="afterbegin"
        hx-swap-oob="true"
    ></div>
<?php else: ?>
    <div id="old_message_getter" hx-swap-oob="true"></div>
<?php endif ?>

<?php
/**
 * New message getter is oob swapped into parent to update $newest_message_id
 */
if ($newest_message_id): ?>
    <div 
        id="new_message_getter" 
        hx-trigger="sse:chat-message" 
        hx-get="/chat/<?= $url_id ?>/messages/since/<?= $newest_message_id ?>"
        hx-target="#chat_messages"
        hx-trigger="sse:chat-message"
        hx-swap="beforeend"
        hx-swap-oob="true"
    ></div>
<?php endif ?>

<?php
/**
 * Main message loop
 */
if ($messages !== null): ?>
    <?php foreach ($messages as $message): ?>
    <div class="flex space-x-2" x-ref="msg_<?= $message->id ?>">
        <?php user_icon(size: 32) ?>
        <div>
            <a class="text-blue-500 hover:text-blue-400 hover:underline font-bold whitespace-nowrap">
                <?= $message->username ?>
            </a>
            <span class="text-sm text-zinc-600 dark:text-zinc-400"><?= Date::format($message->created_at) ?></span>
            <p>
                <?= $message->id ?>: <?= $message->content ?>
            </p>
        </div>
    </div>
    <?php endforeach ?>
<?php elseif ($channel_is_empty): ?>
    <p class="text-zinc-500 italic">
        <?php
        /**
         * @todo Make a more prettier "no messages" message.
         */
        ?>
        No messages yet.
    </p>
<?php endif ?>

