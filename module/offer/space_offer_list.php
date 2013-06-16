<?php
include_once("$config[webroot]/module/offer/includes/offer_class.php");
$offer=new offer();
//====================================================================
$infoList=$offer->space_offer_list($_GET['cat']);
$tpl->assign("info",$infoList);
//====================================================================
include("module/".$_GET['m']."/lang/".$config['language']."/space_".$_GET['action'].".php");
$tpl->assign("lang",$lang);
$tpl->assign("config",$config);
$tpl->assign("com",$company);
//===================================================================
$tpl->assign("keyword",$company['main_pro']);
$tpl->assign("title",$lang['offer_dir'].','.$company['company']);
$tpl->assign("description",$company['company'].','.$lang['description']);

$output=tplfetch("space_offer_list.htm",$flag);
?>