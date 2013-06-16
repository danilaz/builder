<?php
include_once("lang/".$config['language']."/user_admin/global.php");
include("module/video/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/video/includes/plugin_video_class.php");
$video=new video();
//===================================================================
if(isset($_GET['edit']) && !empty($_POST['name']))
{
	$video->edit_video($_GET['edit']);
	msg("main.php?action=m&m=video&menu=info&s=admin_video_list");
}
else if(!empty($_POST['name']))
{
	$admin->check_access('video');
	if($video->add_video())
		msg("main.php?action=m&m=video&menu=info&s=admin_video_list");
}
if(isset($_GET['edit']))
{
	$tpl->assign("de",$video->video_detail($_GET['edit']));
}

$tpl->assign("date",date("Y-n-j"));
 

include($config['webroot']."/config/usergroup.php");
$ifpay=empty($_SESSION["IFPAY"])?2:$_SESSION["IFPAY"];
$my_group=$group[$ifpay]['modeu'];
$tpl->assign('openvideoupload',$my_group['openvideoupload']);
//====================================================================
$re=$video->select_cat();
$tpl->assign("cat",$re);

$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_video.htm");
?>