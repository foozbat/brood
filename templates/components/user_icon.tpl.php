<?php

function user_icon(int $size=32) { 
    $colors = ['zinc','red','orange','yellow','green','blue','purple','pink'];
    $color = $colors[array_rand($colors)];
    
    ?>
    <div class="
        inline-flex overflow-hidden 
        justify-center items-center 
        w-[<?= $size ?>px] min-w-[<?= $size ?>px] h-[<?= $size ?>px] min-h-[<?= $size ?>px]
        text-<?= ($size > 40 ? '3xl' : 'lg') ?>
        text-white
        rounded-md
        bg-gradient-to-b from-<?= $color ?>-700 to-<?= $color ?>-800
    ">
        <i class='bx bx-user'></i>
    </div><?php
};