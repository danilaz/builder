<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");
//==========================================
$dre=explode(".",$_SERVER['HTTP_HOST']);
$dir=trim(dirname($_SERVER['SCRIPT_NAME']), '\,/');//view: abc.**.com/a.php

$true_prefix=str_replace($config['baseurl'],'',$_SERVER['HTTP_HOST']);
$original_prefix=str_replace('http://','',str_replace($config['baseurl'],'',$config['weburl']));
//view:abc.abc.com, baserurl:abc.abc.com, weburl:abc.abc.com ----- true_prefix='';original_prefix='';
//view:abc.ocm view, baseurl:abc.com, weburl:www.abc.com true_prefix='',original_prefix='www'
if(empty($true_prefix)&&!empty($original_prefix))
{
	header("Location: ".$config['weburl']);exit();
}
	
if($true_prefix!=$original_prefix&&empty($dpid)&&empty($dcid)&&empty($dir)&&!empty($config['baseurl'])&&empty($mlang))
{
	if($config['opensuburl'])
	{
		//绑定顶级域名
		$sql="select userid from ".UDOMIN." where domin='"."http://".$_SERVER['HTTP_HOST']."'";
		$db->query($sql);
		$re=$db->fetchRow();
		if($re['userid'])
		{
			$_GET['uid']=$re['userid'];
			include_once("shop.php");
			exit();
		}
		//二级域名转发
		$sql="select userid from ".ALLUSER." where user='$dre[0]'";
		$db->query($sql);
		$re=$db->fetchRow();
		if($_GET['uid']=$re["userid"])
		{
			include_once("shop.php");
			exit();
		}
		//关键词二级域名功能
		if(file_exists('module/keyword/'))
		{
			include_once("includes/smarty_config.php");
			
			$sql="select py from ".CRT_KEYWORD." where py='$dre[0]'";
			$db->query($sql);
			$_GET['id']=$db->fetchField('py');
			$_GET['m']='keyword';
			include("module/keyword/first.php");
			
			$tpl->template_dir=$config['webroot']."/templates/".$config['temp']."/";
			$tpl->assign("out",$out);
			$tpl->caching = false; //设置缓存方式
			$tpl->display("m.htm");
			exit();
		}
		header("Location: ".$config['weburl']);
		exit();
	}
	else
	{
		header("Location: ".$config['weburl']);
		exit();
	}
}
else
{
	$file=$config['webroot'].'/cache/front/index.htm';
	if(file_exists($file) && (time() - filemtime($file)<$config['cacheTime']*1)&&empty($_GET['m']))
	{
		include($file);
	}
	else
	{
		unset($dre);unset($dir);
		include_once("b2bbuilder.php");
	}
}

?>