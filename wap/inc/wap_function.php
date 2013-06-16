<?php
function wapheader($title,$url)
{
	ob_start(); 
	header("Content-type: text/vnd.wap.wml; charset=utf-8");
	/*
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	*/
	echo "<?xml version=\"1.0\"?>\n".
		"<!DOCTYPE wml PUBLIC \"-//WAPFORUM//DTD WML 1.1//EN\" \"http://www.wapforum.org/DTD/wml_1.1.xml\">\n".
		"<wml>\n".
		"<head>\n".
		"<meta http-equiv=\"cache-control\" content=\"max-age=180,private\" />\n".
		"</head>\n".
		"<card title=\"$title\">\n
		<p><a href='$url/wap/'>$title</a><br/>********************</p>";
}

function wapfooter()
{
	ob_end_flush();
	echo"<p>********************<br/><small>Powered by B2Bbuilder</small></p>\n".
		"</card>\n".
		"</wml>";
}
?>