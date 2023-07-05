<!-- will be interpreted as hx-swap-oob="true" by default -->
<form id="form" ws-send>
    <input name="chat_message">
</form>
<!-- will be appended to #notifications div -->
<div id="chat_room" hx-swap-oob="beforeend">
    <div>Bill: <?= $chat_message ?></div>
</div>