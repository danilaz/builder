<?php
include_once("$config[webroot]/lang/".$config['language']."/user_admin/global.php");
include_once("$config[webroot]/module/product/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/product/includes/plugin_pro_class.php");
$pro=new pro();
//============================================================================
include_once("includes/page_utf_class.php");
if(!empty($deid))
{
	$pro->del_pro($deid);
}
elseif(isset($_GET['update']))
{
	if($_GET['update']=="all")
		$admin->check_access('refresh_all_pro');
	$pro  ->  update_pro($_GET['update']);
}
$tpl->assign("pro_rec",$pro->get_user_rec($buid));
$tpl->assign("re",$pro->pro_list());
//==================================
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_product_list.htm");
?>