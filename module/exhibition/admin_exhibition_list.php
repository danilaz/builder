<?php
include_once("lang/".$config['language']."/user_admin/global.php");

include_once("$config[webroot]/module/".$_GET['m']."/includes/plugin_exhibition_class.php");
//=========================================================================================

$exhibition=new exhibition();
include_once("includes/page_utf_class.php");
if(isset($_GET['deid']))
	$exhibition->del_exhibition($_GET['deid']);
	
$tpl->assign("re",$exhibition->admin_exhibition_list());

//==========================================================================================
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_exhibition_list.htm")
?>