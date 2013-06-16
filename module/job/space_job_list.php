<?php
include_once($config['webroot']."/includes/page_utf_class.php");
include_once($config['webroot']."/module/job/includes/plugin_hr_class.php");
$hr=new hr();
//====================================================================
$re=$hr->admin_hr_list($_GET['uid']);
$tpl->assign("re",$re);
$tpl->assign("keyword",$company['company']);
$tpl->assign("title",$company['company']);
$tpl->assign("description",$company['company']);
//====================================================================
include("module/".$_GET['m']."/lang/".$config['language']."/space_".$_GET['action'].".php");
$tpl->assign("lang",$lang);
$tpl->assign("config",$config);
$tpl->assign("com",$company);
$output=tplfetch("space_job_list.htm",$flag);
?>