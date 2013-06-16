<?php
	include_once("$config[webroot]/module/offer/includes/offer_class.php");
	include_once("lang/".$config['language']."/company_type_config.php");
	$offer=new offer();
	//====================================================================
	user_read_rec($buid,$_GET['id'],2);//��¼��Ա�鿴��Ʒ
	
	$info=$offer->shop_info_detail($_GET['id']);
	foreach($info['pic'] as $k => $v)
    if($v!=0)
      $pics[] = $v;
  $info['pic'] = $pics;
     // unset($info['pic'][$k]); 
//	print_r($info);
	$tpl->assign("info",$info);
	$tkey=$info['type'];
	$tpl->assign("title",$infoType[$tkey].$info['title'].",".$info['keywords'].$company['company']);
	$tpl->assign("keyword",$info['keywords'].','.$company['company']);
	$tpl->assign("description",$info['con']);
	//====================================================================
	include_once("lang/".$config['language']."/user_space/global.php");
	include_once("module/".$_GET['m']."/lang/".$config['language']."/space_".$_GET['action'].".php");
	$tpl->assign("lang",$lang);
	$tpl->assign("config",$config);
	$output=tplfetch("space_offer_detail.htm",$flag);
?>