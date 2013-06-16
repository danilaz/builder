<?php
include_once("$config[webroot]/module/demand/includes/demand_class.php");
$demand=new demand();
//====================================================================
$infoList=$demand->space_demand_list($_GET['cat']);
$tpl->assign("info",$infoList);
//====================================================================
include("module/".$_GET['m']."/lang/".$config['language']."/space_".$_GET['action'].".php");
$tpl->assign("lang",$lang);
$tpl->assign("config",$config);
$tpl->assign("com",$company);
//===================================================================
$tpl->assign("keyword",$company['main_pro']);
$tpl->assign("title",$lang['demand_dir'].','.$company['company']);
$tpl->assign("description",$company['company'].','.$lang['description']);

$output=tplfetch("space_demand_list.htm",$flag);
?>