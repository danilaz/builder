<?php
include_once("$config[webroot]/lang/".$config['language']."/user_admin/global.php");
include_once("$config[webroot]/module/brand/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/brand/includes/plugin_brand_class.php");
include_once("$config[webroot]/includes/page_utf_class.php");
$brand=new brand();
if(!empty($_GET['deid']))
{
	$brand -> del_brand($_GET['deid']);	
	msg("main.php?action=m&m=brand&s=admin_brand_list&menu=info");
}
$re=$brand->admin_brand_list();
$tpl->assign("re",$re);
//==================================
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_brand_list.htm");

?>