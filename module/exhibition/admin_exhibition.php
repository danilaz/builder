<?php
include_once("lang/".$config['language']."/user_admin/global.php");
/*include("module/".$_GET['m']."/lang/".$config['language']."/".$_GET['s'].".php");*/
include_once("$config[webroot]/module/".$_GET['m']."/includes/plugin_exhibition_class.php");
//==========================================================================================
	
	$exhibition=new exhibition();
	if($submit=="submit")
	{
		//$admin->check_access('news');
		$exhibition->add_exhibition();
	}
	if($submit=="edit")
		$exhibition->edit_exhibition();
	
	if(isset($_GET['edit']))
	{
		$de=$exhibition->exhibition_detail($_GET['edit']);
		$tpl->assign("de",$de);
	}
	else
		$admin->check_myshop();
//		
//	include($config['webroot']."/config/usergroup.php");
//	$ifpay=$_SESSION['IFPAY'];
//	$my_group=$group[$ifpay]['modeu'];
//	$tpl->assign("my_group",$my_group);
//	$tpl->assign("newsCat",$news->news_cat_list());
	
	
//==========================================================================================
$tpl->assign("prov",get_province($de["province"]));
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_exhibition.htm");
?>