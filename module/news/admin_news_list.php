<?php
	include_once("$config[webroot]/module/".$_GET['m']."/includes/plugin_news_class.php");
	include_once("lang/".$config['language']."/user_admin/global.php");
	include_once("module/news/lang/".$config['language']."/".$_GET['s'].".php");
	include_once("includes/page_utf_class.php");
	
	$news=new news();

	$re=$news->get_news();
	$tpl->assign("news",$re);
	if(isset($_GET['deid']))
	{
		$news->del_news($_GET['deid']);
	}
	
	$tpl->assign("config",$config);
	$tpl->assign("lang",$lang);
	$output=tplfetch("admin_news_list.htm");

?>