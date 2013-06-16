<?php
include_once("module/product/includes/plugin_pro_class.php");
$product=new pro();
//====================================================================

$re=$product->shop_pro_list();
$de=$product->get_user_common_lower_cat();
$tpl->assign("keyword",$company['company']);
$tpl->assign("title",$company['company']);
$tpl->assign("description",$company['company']);
$tpl->assign("info",$re);
$tpl->assign("cat",$de);
	
//====================================================================
include("module/".$_GET['m']."/lang/".$config['language']."/space_".$_GET['action'].".php");
$tpl->assign("lang",$lang);
$tpl->assign("config",$config);
$tpl->assign("com",$company);
$output=tplfetch("space_product_list.htm",$flag);
?>