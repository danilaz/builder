<?php
include_once("lang/".$config['language']."/user_admin/global.php");
include("module/job/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/job/includes/plugin_hr_class.php");
$hr=new hr();
//====================================================================
include_once("$config[webroot]/includes/page_utf_class.php");
$hr->del_resume($deid);
$tpl->assign("re",$hr->admin_resume_list());
//====================================================================
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_resume_list.htm")
?>