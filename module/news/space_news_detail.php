<?php
	
	include_once("$config[webroot]/module/news/includes/plugin_news_class.php");
	$news=new news();
	//====================================================================
	
	$info=$news->space_news_detail();
	$tpl->assign("info",$info);
	$tpl->assign("title",$info['title']);
	$tpl->assign("keyword",$info['title'].','.$company['company']);
	$tpl->assign("description",$info['title'].'-'.$info['keywords'].'-'.$company['company']);

				
				
	/*
	user_read_rec($buid,$_GET['id'],2);//记录会员查看产品
	
	$info=$offer->shop_info_detail($_GET['id']);
	$tpl->assign("info",$info);
	$tkey=$info['type'];
	$tpl->assign("title",$infoType[$tkey].$info['title'].",".$info['keywords'].$company['company']);
	$tpl->assign("keyword",$info['keywords'].','.$company['company']);
	$tpl->assign("description",$info['con']);*/
	//====================================================================
	include_once("lang/".$config['language']."/front/global.php");
	include_once("module/".$_GET['m']."/lang/".$config['language']."/space_".$_GET['action'].".php");
	$tpl->assign("lang",$lang);
	$tpl->assign("config",$config);
	$output=tplfetch("space_new_detail.htm",$flag);
?>