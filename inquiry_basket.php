<?php
/**
 * powered by b2bbuilder
 * Coprighty http://www.b2b-builder.com
 * Auter:brad zhang;
 * Des:abouts us
 */
include_once("includes/global.php");
include_once("includes/smarty_config.php");
//===================================
$del=false;
if(!empty($_GET['pid']))
{
	$va=$_COOKIE['pro_inquery'];
	$ar=explode(",",$_GET['pid']);
	foreach($ar as $v)
	{
		if($v!='')
			$va=str_replace($v.',',NULL,$va);
	}
	setcookie("pro_inquery",$va,time()*24*30,"/",$config['baseurl']);
	$del=true;	
}
if(!empty($_GET['cid']))
{
	$va=$_COOKIE['com_inquery'];
	$ar=explode(",",$_GET['cid']);
	foreach($ar as $v)
	{
		if($v!='')
			$va=str_replace($v.",",'',$va);
	}
	setcookie("com_inquery",$va,time()*24*30,"/",$config['baseurl']);
	$del=true;	
}
if(!empty($_GET['iid']))
{
	$va=$_COOKIE['info_inquery'];
	$ar=explode(",",$_GET['iid']);
	foreach($ar as $v)
	{
		if($v!='')
			$va=str_replace($v.",",'',$va);
	}
	setcookie("info_inquery",$va,time()*24*30,"/",$config['baseurl']);
	$del=true;	
}
if($del)
	msg('inquiry_basket.php');

if(!empty($_COOKIE['pro_inquery']))
{
	$sql="select a.company,b.pname as subject,a.userid,b.id from ".USER." a ,".PRO." b where
	 a.userid=b.userid and b.id in($_COOKIE[pro_inquery])";
	$db->query($sql);
	$re=$db->getRows();
	$tpl->assign("prolist",$re);
}

if(!empty($_COOKIE['com_inquery']))
{
	$sql="select company,ctype as subject,userid from ".USER." where userid in ($_COOKIE[com_inquery])";
	$db->query($sql);
	$re=$db->getRows();
	$tpl->assign("comlist",$re);
}

if(!empty($_COOKIE['info_inquery']))
{
	$sql="select a.company,b.title as subject,a.userid,b.id from ".USER." a ,".INFO." b where 
	a.userid=b.userid and b.id in($_COOKIE[info_inquery])";
	$db->query($sql);
	$re=$db->getRows();
	$tpl->assign("infolist",$re);
}
//======================================
include_once("footer.php");
$tpl->display('inquiry_basket.htm');
?>