<?php
include_once("$config[webroot]/lang/".$config['language']."/user_admin/global.php");
include_once("$config[webroot]/module/product/lang/".$config['language']."/".$_GET['s'].".php");
include_once("module/product/includes/plugin_order_class.php");
$order=new order();
//---------------------------------------------------------
if(!empty($_POST['submit']))
{	
	$order->update_price($_POST['price']*1,$_GET['oid']*1);
}
//----------------------------------------------------------
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_edit_price.htm",NULL,'true');
?>