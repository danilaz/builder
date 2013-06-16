<?php
include_once("lang/".$config['language']."/user_admin/global.php");
include("module/job/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/job/includes/plugin_hr_class.php");
$hr=new hr();
//===================================================================
include_once("module/job/lang/".$config['language']."/lang_hr_config.php");
$tpl->assign("hrcat",$hr->hrcat());
$tpl->assign("hrmoney",$hrmoney);
if($submit=="submit")
{
	$admin->check_access('hr');
	$hr->add_hr();
}
if($submit=="edit")
	$hr->edit_hr();
if(isset($_GET['edit']))
	$tpl->assign("de",$hr->hr_detail($_GET['edit']));
$admin->check_myshop();
//====================================================================
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_job.htm")

?>