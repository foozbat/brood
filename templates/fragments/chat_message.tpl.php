<?php
/**
 * Chat messages block fragment
 */

require_once "components/user_icon.tpl.php";

?>
<div
    hx-get="/test_chat/messages"
    hx-trigger="intersect once"
    hx-target="#chat_messages"
    hx-swap="afterbegin"

    x-init="$nextTick(() => { $refs.chat_container.scrollTop = $refs.msg_<?= $chats[count($chats)-1]['chat_id'] ?>.offsetTop })"
></div>

<?php foreach ($chats as $message): ?>
<div class="flex space-x-2" x-ref="msg_<?= $message['chat_id'] ?>">
    <?php user_icon(size: 32) ?>
    <div>
        <a class="text-blue-500 hover:text-blue-400 hover:underline font-bold whitespace-nowrap">
            <?= $message['poster'] ?>
        </a>
        <span class="text-sm text-zinc-600 dark:text-zinc-400">1:29pm</span>
        <p>
            <?= $message['content'] ?>
        </p>
    </div>
</div>
<?php endforeach ?>