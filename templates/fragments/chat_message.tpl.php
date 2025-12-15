<?php
/**
 * Chat messages block fragment
 */

require_once "components/user_icon.tpl.php";

?>
<!--
<div
    hx-get="/chat/asdfasdf/messages"
    hx-trigger="intersect once"
    hx-target="#chat_messages"
    hx-swap="afterbegin"

    x-init="$nextTick(() => { $refs.msg_</?= $chats[count($chats)-1]['chat_id'] ?\>.scrollIntoView() })"
></div>-->

<?php if ($messages !== null): ?>
    <?php foreach ($messages as $message): ?>
    <div class="flex space-x-2" x-ref="msg_<?= $message->id ?>">
        <?php user_icon(size: 32) ?>
        <div>
            <a class="text-blue-500 hover:text-blue-400 hover:underline font-bold whitespace-nowrap">
                <?= $message->username ?>
            </a>
            <span class="text-sm text-zinc-600 dark:text-zinc-400">1:29pm</span>
            <p>
                <?= $message->content ?>
            </p>
        </div>
    </div>
    <?php endforeach ?>
<?php else: ?>
    <p class="text-zinc-500 italic">No messages yet.</p>
<?php endif ?>

