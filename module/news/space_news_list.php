<?php
include_once("$config[webroot]/module/news/includes/plugin_news_class.php");
$news=new news();
//====================================================================
$news->space_news_list();
$tpl->assign("keyword",$company['company']);
$tpl->assign("title",$company['company']);
$tpl->assign("description",$company['company']);
$page  ="space_news_list.htm";
				
//====================================================================
include("module/".$_GET['m']."/lang/".$config['language']."/space_".$_GET['action'].".php");
$tpl->assign("lang",$lang);
$tpl->assign("config",$config);
$tpl->assign("com",$company);
$output=tplfetch("space_news_list.htm",$flag);
?>