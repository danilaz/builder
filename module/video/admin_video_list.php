<?php
include_once("lang/".$config['language']."/user_admin/global.php");
include("module/video/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/video/includes/plugin_video_class.php");
//===========================================================
$video=new video();
if(isset($_GET['deid']))
	$video->del_video($_GET['deid']);
if(isset($_GET['cancel_tj']) || isset($_GET['user_tj']))
	$video->update_video_state();
$tpl->assign("video",$video->video_list());
//===========================================================
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_video_list.htm");
?>