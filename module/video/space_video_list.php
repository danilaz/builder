<?php
include_once("$config[webroot]/module/video/includes/plugin_video_class.php");
$video=new video();
//------------------------------------
$re=$video->video_list($_GET['uid']);
$tpl->assign("videolist",$re);
//------------------------------------
include("module/".$_GET['m']."/lang/".$config['language']."/space_".$_GET['action'].".php");
$tpl->assign("lang",$lang);
$tpl->assign("config",$config);
$tpl->assign("com",$company);
//------------------------------------
$tpl->assign("keyword",$company['company']);
$tpl->assign("title",$company['company']);
$tpl->assign("description",$company['company']);
//------------------------------------
$output=tplfetch("space_video_list.htm",$flag);
?>