<?php
include_once("includes/global.php");
//=================================
function showUser()
{
	global $config,$db,$buid;
	$new=$inum=0;
	include($config["webroot"]."/lang/".$config['language']."/lang_login.php");
	//$getstr=count($_GET)?'?'.implode('&',convert($_GET)):NULL;
	if(!empty($_COOKIE['USER']))
		$new="";
	else
		/*$new="<a href='".$config["weburl"]."/$config[regname]'>".$log["sigin"]."</a> | <a href='".$config["weburl"]."/login.php'>".$log["login"]."</a>";*/
	if(!empty($_COOKIE['info_inquery']))
		$inum=count(array_unique(explode(",",$_COOKIE['info_inquery'])))-1;
	if(!empty($_COOKIE['pro_inquery']))
		$inum+=count(array_unique(explode(",",$_COOKIE['pro_inquery'])))-1;
	if(!empty($_COOKIE['com_inquery']))
		$inum+=count(array_unique(explode(",",$_COOKIE['com_inquery'])))-1;
		//print_r($_COOKIE);
	$inquiry="<a href='$config[weburl]/inquiry_basket.php'>$log[inquiry] ($inum)</a></span>";
		return $inquiry;
}
echo "document.write(\"".showUser()."\");";
?>