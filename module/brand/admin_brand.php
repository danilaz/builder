<?php
include_once("$config[webroot]/lang/".$config['language']."/user_admin/global.php");
include_once("$config[webroot]/module/brand/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/brand/includes/plugin_brand_class.php");
$brand=new brand();
//============================================================
if(!empty($submit)&&empty($_POST['editID']))
{
	$re=$brand->add_brand();
	if($re)
		msg("main.php?action=m&m=brand&s=admin_brand_list&menu=info");
}
if(isset($_POST['editID']))
{
	$re=$brand->edit_brand();
	if($re)
		msg("main.php?action=m&m=brand&s=admin_brand_list&menu=info");
}
if(isset($_GET['edit']))
{
	$tpl->assign("de",$brand->brand_detail($_GET['edit']));
}

//==================================
$tpl->assign("country",country_list());
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_brand.htm");
?>