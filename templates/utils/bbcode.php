<?php

function bbcode(string $text)
{
	// BOLD
	$text = preg_replace('/\[b\]/si', '<b>', $text);
	$text = preg_replace('/\[\/b\]/si', '</b>', $text);

	// ITALICS
	$text = preg_replace('/\[i\]/si', '<i>', $text);
	$text = preg_replace('/\[\/i\]/si', '</i>', $text);

	// UNDERLINE
	$text = preg_replace('/\[u\]/si', '<u>', $text);
	$text = preg_replace('/\[\/u\]/si', '</u>', $text);

	// STRIKETHROUGH
	$text = preg_replace('/\[s\]/si', '<del>', $text);
	$text = preg_replace('/\[\/s\]/si', '</del>', $text);

	// LIST
  	$text = preg_replace('/(\n{0,1})\[list\](\n{0,1})/si', '<ul class="list-disc list-inside">', $text);
	$text = preg_replace('/(\n{0,1})\[\/list\](\n{0,1})/si', '</ul>', $text);

	// LI
	$text = str_replace('[*]', '<li>', $text);

	// IMAGE SRC
    $text = preg_replace('/\[img\](mailto:)?(\S+?)(\.jpe?g|\.gif|\.png)\[\/img\]/si', '<img src=slate\\2\\3slate border=0 alt=slate\\1\\2\\3slate>', $text);

	// FONT SIZE
	$text = preg_replace('/\[size=(\d{1,2})\](.*?)\[\/size\]/si', '<span class="text-[\\1px]">\\2</span>', $text);

	// FONT COLOR
	$text = preg_replace('/\[color=(\S+?)\](.*?)\[\/color\]/si', '<span class="font-\\1-800">\\2</span>', $text);

	// HYPERLINK
	$text = preg_replace('/\[url\](http|https|ftp)(:\/\/\S+?)\[\/url\]/si', '<a href="\\1\\2" class="link" target="_blank" rel="noopener noreferrer">\\1\\2</a>', $text);
    $text = preg_replace('/\[url\](\S+?)\[\/url\]/si', '<a href=slatehttps://\\1slate class="link" target="_blank" rel="noopener noreferrer">\\1</a>', $text);
    $text = preg_replace('/\[url=(http|https|ftp)(:\/\/\S+?)\](.*?)\[\/url\]/si', '<a href="\\1\\2" class="link" target="_blank" rel="noopener noreferrer">\\3</a>', $text);
    $text = preg_replace('/\[url=(\S+?)\](\S+?)\[\/url\]/si', '<a href=slatehttps://\\1slate class="link" target="_blank" rel="noopener noreferrer">\\2</a>', $text);

	// EMAIL LINK
    $text = preg_replace('/\[email\](\S+?@\S+?\\.\S+?)\[\/email\]/si', '<a href="mailto:\\1" class="link">\\1</a>', $text);
    $text = preg_replace('/\[email=(\S+?@\S+?\\.\S+?)\](.*?)\[\/email\]/si', '<a href=slatemailto:\\1slate class="link">\\2</a>', $text);

    // QUOTE
	$text = preg_replace('/\[quote\](\n{0,1})(.*?)\[\/quote\](\n{0,1})/si', '<div class="quote">\\2</div>', $text);
	$text = preg_replace('/\[quote=(.*?)\](\n{0,1})(.*?)\[\/quote\](\n{0,1})/si', '<div class="quote"><p class="quote-ref">\\1 wrote:</p>\\3</div>', $text);

	// CODE
	$text = preg_replace('/\[code\](\n{0,1})(.*?)\[\/code\](\n{0,1})/si', '<pre><p class="code-title">Code:</p><code>\\2</code></pre>', $text);

	return $text;
}