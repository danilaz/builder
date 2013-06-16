<?php
include_once("module/product/includes/plugin_pro_class.php");
$product=new pro();
//====================================================================

$re=$product->shop_pro_list();
$tpl->assign("proList",$re);
include_once("lang/".$config['language']."/company_type_config.php");
$tpl->assign("trade_type",$trade_type);
$info=$product->product_detail($id);
$tpl->assign("info",$info);
$tpl->assign("title",$info['pname'].",".$info['keywords'].$company['company']);
$tpl->assign("keyword",$info['keywords'].','.$company['company']);
$tpl->assign("description",$info['con']);
unset($info);

//====================================================================
include("module/".$_GET['m']."/lang/".$config['language']."/space_".$_GET['action'].".php");
$tpl->assign("lang",$lang);
$tpl->assign("config",$config);
$tpl->assign("com",$company);
$output=tplfetch("space_product_detail.htm",$flag);
?>