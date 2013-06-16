<?php
include_once($config['webroot']."/module/job/includes/plugin_hr_class.php");
$hr=new hr();
//====================================================================
$info=$hr->hr_shop_detail($id);
$tpl->assign("rc",$info);
$tpl->assign("title",$info['title'].",".$company['company']);
$tpl->assign("keyword",$info['title'].",".$company['company']);
$tpl->assign("description",$info['title'].",".$company['company']);
//====================================================================
include("module/".$_GET['m']."/lang/".$config['language']."/space_".$_GET['action'].".php");
$tpl->assign("lang",$lang);
$tpl->assign("config",$config);
$tpl->assign("com",$company);
$output=tplfetch("space_job_detail.htm",$flag);
?>