<?php
if ($_SERVER["HTTP_IF_MODIFIED_SINCE"]) {
	header("HTTP/1.1 304 Not Modified");
	exit;
}

header("Expires: " . gmdate("D, d M Y H:i:s", time() + 365*24*60*60) . " GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

if ($_GET["file"] == "favicon.ico") {
	header("Content-Type: image/x-icon");
	echo base64_decode(compile_file('../adminer/static/favicon.ico', 'base64_encode'));
} elseif ($_GET["file"] == "default.css") {
	header("Content-Type: text/css; charset=utf-8");
	echo lzw_decompress(compile_file('../adminer/static/default.css', 'minify_css'));
} elseif ($_GET["file"] == "functions.js") {
	header("Content-Type: text/javascript; charset=utf-8");
	echo lzw_decompress(compile_file('../adminer/static/functions.js;static/editing.js', 'minify_js'));
} else {
	header("Content-Type: image/gif");
	switch ($_GET["file"]) {
		case "plus.gif": echo compile_file('../adminer/static/plus.gif'); break;
		case "cross.gif": echo compile_file('../adminer/static/cross.gif'); break;
		case "up.gif": echo compile_file('../adminer/static/up.gif'); break;
		case "down.gif": echo compile_file('../adminer/static/down.gif'); break;
		case "arrow.gif": echo compile_file('../adminer/static/arrow.gif'); break;
	}
}
exit;
