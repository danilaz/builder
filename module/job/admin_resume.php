<?php
include_once("lang/".$config['language']."/user_admin/global.php");
include("module/job/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/job/includes/plugin_hr_class.php");
$hr=new hr();
//=========================================================================
	if($submit=="submit")
	{
		$hr->add_resume();
		msg("main.php?action=m&m=job&s=admin_resume_list&menu=user");
	}
	if($submit=="edit")
		$hr->edit_resume();
	if(isset($_GET['edit']))
		$tpl->assign("de",$hr->resume_detail($_GET['edit']));
		
	include_once("module/job/lang/".$config['language']."/lang_hr_config.php");
	$tpl->assign("hrcat",$hr->hrcat());
	$tpl->assign("hrmoney",$hrmoney);
	$tpl->assign("degree",$degree);
	$tpl->assign("language_arr",$language_arr);
	$tpl->assign("language_darr",$language_darr);
	$tpl->assign("job_type",$job_type);
	$tpl->assign("situations",$situations);
//====================================================================
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_resume.htm")
?>