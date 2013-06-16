<?php
include_once("$config[webroot]/lang/".$config['language']."/user_admin/global.php");
include_once("$config[webroot]/module/product/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/product/includes/plugin_order_class.php");
$order=new order();
//--------------------------------
include_once("includes/page_utf_class.php");
if(isset($_GET['flag'])&&is_numeric($_GET['flag'])&&!empty($_GET['id'])&&is_numeric($_GET['id']))
	$order->orderoption($_GET['id'],$_GET['flag'],0);
if (isset($_GET['status']))
	$tpl->assign("blist",$order->buyorder($_GET['status']));
else
	$tpl->assign("blist",$order->buyorder());
//---------------------------------
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_buyorder.htm");
?>