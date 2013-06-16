<?php
include_once("$config[webroot]/lang/".$config['language']."/user_admin/global.php");
include_once("$config[webroot]/module/product/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/product/includes/plugin_pro_class.php");
$pro=new pro();
//============================================
if($submit=="submit")
{
	$pro->add_product_batch();
	$tpl->assign("uploaded",1);
}
$re=$admin->getCatName(PCAT);
$tpl->assign("cat",$re);
//==============================================
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_product_batch.htm");
?>