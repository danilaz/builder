<?php
include_once("$config[webroot]/lang/".$config['language']."/user_admin/global.php");
include_once("$config[webroot]/module/product/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/product/includes/plugin_order_class.php");
$order=new order();
//==============================
if(!empty($_GET['id'])&&is_numeric($_GET['id']))
{
	$tpl->assign("odetail",$order->orderdetail($_GET['id'],$_GET['type']));
}
//==================================
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_orderdetail.htm");
?>