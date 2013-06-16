<?php
include_once("includes/global.php");
//=================================
function showUser()
{
	global $config,$db,$buid;
	$new=$inum=0;
	include($config["webroot"]."/lang/".$config['language']."/lang_login.php");
	
	if($buid)
	{
		include_once($config["webroot"]."/includes/plugin_msg_class.php");
		$msg=new msg();
		$new=$msg->getMailNum();
		$new=$new['new'];
		if($new>0)
		{
			$new=" | <BGSOUND balance=0 src='$config[weburl]/image/default/newmsg.wma' volume=-600 loop=0><a href='$config[weburl]/main.php?action=admin_mail_list'><img src='$config[weburl]/image/default/notice_newpm.gif' />".$log['new_msg']."($new)</a> ";
		}
		else
			$new=NULL;
	}
	//$getstr=count($_GET)?'?'.implode('&',convert($_GET)):NULL;
	if(!empty($_COOKIE['USER']))
		$new="<a href='$config[weburl]/main.php'>".$log["myoffice"]."</a> | <a href='$config[weburl]/main.php?action=logout'>".$log["logout"]."</a>";
	else
		$new="<a href='".$config["weburl"]."/$config[regname]'>".$log["sigin"]."</a> | <a href='".$config["weburl"]."/login.php'>".$log["login"]."</a>";
	if(!empty($_COOKIE['info_inquery']))
		$inum=count(array_unique(explode(",",$_COOKIE['info_inquery'])))-1;
	if(!empty($_COOKIE['pro_inquery']))
		$inum+=count(array_unique(explode(",",$_COOKIE['pro_inquery'])))-1;
	if(!empty($_COOKIE['com_inquery']))
		$inum+=count(array_unique(explode(",",$_COOKIE['com_inquery'])))-1;
		//print_r($_COOKIE);
	$inquiry="| <a href='$config[weburl]/inquiry_basket.php'>$log[inquiry]</a> ($inum)";
		return $new.$inquiry;
}
echo "document.write(\"".showUser()."\");";
?>