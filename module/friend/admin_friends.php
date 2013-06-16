<?php
include_once("$config[webroot]/lang/".$config['language']."/user_admin/global.php");
include_once("$config[webroot]/module/friend/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/friend/includes/plugin_friend_class.php");
$friend=new friend();
//============================================================
if(isset($_GET['editid'])&&is_numeric($_GET['editid']))
	$tpl->assign("de",$friend->edit_friend_info($_GET['editid']));
	
if(isset($_GET['friendid']))
	$tpl->assign("de",$friend->get_friend_info($_GET['friendid']));
if(isset($_GET['detail_id'])&&is_numeric($_GET['detail_id']))
	$tpl->assign("de",$friend->edit_friend_info($_GET['detail_id']));
if(isset($_POST['isure']))
{
	if(!empty($_POST['editid']))
		$friend->update_friend_info($_POST['editid']);
	else
		$friend->update_friend_info();
}

//==================================
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_friends.htm");
?>