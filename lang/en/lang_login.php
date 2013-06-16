<?php
if(isset($_COOKIE["USER"]))
	$log["myoffice"]="<font color='red'>Hello ".$_COOKIE["USER"]."! My Office</font>";

$log['new_msg']='New Mail';
$log["logout"]="Sign Out";
$log["sigin"]="Join Now";
$log["login"]="Sign In";

$log["logtitle"]="Sign In";
$log["username"]="ID:";
$log["pass"]="Password:";
$log["lostpass"]="Loss Password？";
$log["wcom"]="Welcome:";
$log["tady"]="Today is :".date("Y-m-d")." wish you have a good day";
$log["viepage"]="&raquo;Browse my site";
$log["enter"]=" &raquo;Login my office";
$log["inquiry"]="Inquiry Basket";
?>