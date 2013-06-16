<?php
include_once("$config[webroot]/lang/".$config['language']."/user_admin/global.php");
include_once("$config[webroot]/module/demand/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/demand/includes/demand_class.php");
include_once("$config[webroot]/includes/page_utf_class.php");
$demand=new demand();
//============================================================
if(isset($_GET['deid']))
{
	$demand -> del_info($_GET['deid']);
}

if(!empty($_GET['update'])&&!is_numeric($_GET['update']))
{
	if($_GET['update']=="all")
		$admin->check_access('refresh_all_demand');
	$demand -> update_info($_GET['update']);
}
if(!empty($_GET['update'])&&is_numeric($_GET['update']))
{
	$demand -> update_info($_GET["update"]);
	echo 1;die;
}

$tpl  -> assign("re",$demand ->  info_list());
//==================================
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_demand_list.htm");

?>