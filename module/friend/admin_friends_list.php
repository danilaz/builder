<?php
include_once("$config[webroot]/lang/".$config['language']."/user_admin/global.php");
include_once("$config[webroot]/module/friend/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/friend/includes/plugin_friend_class.php");
$friend=new friend();
//============================================================
include_once("$config[webroot]/includes/page_utf_class.php");
if(isset($_GET['delid'])&&is_numeric($_GET['delid']))
{
	$friend->del_friend_info($_GET['delid']);
}
$tpl->assign("re",$friend->friends_list());
//==================================
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_friends_list.htm");
?>