<?php
include_once("$config[webroot]/lang/".$config['language']."/user_admin/global.php");
include_once("$config[webroot]/module/product/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/product/includes/plugin_order_class.php");
include_once("$config[webroot]/includes/page_utf_class.php");
$order=new order();
//=====================================================================
if(isset($_GET['flag'])&&isset($_GET['id'])&&is_numeric($_GET['flag'])&&is_numeric($_GET['id']))
	echo $order->orderoption($_GET['id'],$_GET['flag'],1);
if (isset($_GET['status']))
	$tpl->assign("slist",$order->sellorder($_GET['status']));
else
	$tpl->assign("slist",$order->sellorder());
//=====================================================================
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_sellorder.htm");
?>