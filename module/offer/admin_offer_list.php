<?php
include_once("$config[webroot]/lang/".$config['language']."/user_admin/global.php");
include_once("$config[webroot]/module/offer/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/offer/includes/offer_class.php");
include_once("$config[webroot]/includes/page_utf_class.php");
$offer=new offer();
//============================================================
if(isset($_GET['deid']))
{
	$offer -> del_info($_GET['deid']);
}

if(!empty($_GET['update'])&&!is_numeric($_GET['update']))
{
	if($_GET['update']=="all")
		$admin->check_access('refresh_all_offer');
	$offer -> update_info($_GET['update']);
}
if(!empty($_GET['update'])&&is_numeric($_GET['update']))
{
	$offer -> update_info($_GET["update"]);
	echo 1;die;
}

$tpl  -> assign("re",$offer ->  info_list());
//==================================
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_offer_list.htm");

?>