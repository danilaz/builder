<?php
	include_once("$config[webroot]/module/".$_GET['m']."/includes/plugin_news_class.php");
	include_once("lang/".$config['language']."/user_admin/global.php");
	include_once("module/news/lang/".$config['language']."/".$_GET['s'].".php");
	$news=new news();
	$class=$news->get_newsclass();
	$tpl->assign("class",$class);
	$admin->check_myshop();	
	if(isset($_GET['newsid']) and $_POST['action']=="edit")
	{
		$news->fun_news('edit');
	}
	if(!isset($_GET['newsid']) and $_POST['action']=="add")
	{
		$news->fun_news('add');
	}
	if(isset($_GET['newsid']))
	{
		$tpl->assign("news",$news->news_detail($_GET['newsid']));	
	}
	else
	{
		$admin->check_access('news');
	}


//==================================
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_news.htm");
?>
