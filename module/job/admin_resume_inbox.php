<?php
include_once("lang/".$config['language']."/user_admin/global.php");
include("module/job/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/job/includes/plugin_hr_class.php");
include_once("module/job/lang/".$config['language']."/lang_hr_config.php");
$hr=new hr();
//===================================================================
	include_once("$config[webroot]/includes/page_utf_class.php");
	/*$hr->del_hr($deid);
	if(isset($_GET['update']))
		$hr->update_hr($_GET['update']);
	$tpl->assign("re",$hr->admin_hr_list());*/
	
	if($_GET['jid']=="")
	$tpl->assign("re",$hr->admin_rbox_list());
	else
	$tpl->assign("re",$hr->admin_resumebox_list());
	if(isset($_GET['rbid']))
	$hr->del_rbid($_GET['rbid']);
//==============================================
$tpl->assign("degree",$degree);
$tpl->assign("state",$state);
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_resume_inbox.htm")
?>