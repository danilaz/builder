<?php
include_once("$config[webroot]/lang/".$config['language']."/user_admin/global.php");
include_once("$config[webroot]/module/friend/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/friend/includes/plugin_friend_class.php");
$friend=new friend();
//============================================================
if(isset($_POST['msgsend'])&&$_POST['sendid']!=',')
{
	include_once("$config[webroot]/includes/plugin_msg_class.php");
	$msg=new msg();
	$msg->friend_msg_batch_send();
}
$info=$friend->get_batch_friend_info();
$tpl->assign("re",$info);

//==================================
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_friends_batchmail.htm");
?>