<?php
include_once("$config[webroot]/module/video/includes/plugin_video_class.php");
$video=new video();
//----------------------------------------
$vd=$video->video_detail($_GET['id']);
$tpl->assign("de",$vd);
//------------------------------------
include("module/".$_GET['m']."/lang/".$config['language']."/space_".$_GET['action'].".php");
$tpl->assign("lang",$lang);
$tpl->assign("config",$config);
$tpl->assign("com",$company);
//----------------------------------------
$tpl->assign("title",$vd['name'].",".$vd['keyword'].$company['company']);
$tpl->assign("keyword",$vd['keyword']);
$tpl->assign("description",csubstr($vd['desc'],0,100));
//------------------------------------
$output=tplfetch("space_video_detail.htm",$flag);

?>