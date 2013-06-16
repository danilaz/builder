<?php
include_once("lang/".$config['language']."/user_admin/global.php");
include("module/album/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/album/includes/plugin_album_class.php");
include_once("includes/page_utf_class.php");
$album=new album();
//==========================================
if(isset($_GET['editid']))
	$tpl->assign("re",$album->album_detail($_GET['editid']));
$act=isset($_POST['action'])?$_POST['action']:NULL;

if($act=="submit")
{							
	if(isset($_POST['up_type']) && $_POST['up_type']=='multi')
	{
		if($strid=$album->add_multi_album())
		{
			$head=isset($_GET['nohead'])?'&nohead='.$_GET['nohead']:'';
			if(isset($_POST['album_custom_cat']))
				msg("main.php?menu=$_GET[menu]&action=m&m=album&s=admin_album&info=1&strid=$strid&catid=$_POST[album_custom_cat]".$head);
			else
				msg("main.php?menu=$_GET[menu]&action=m&m=album&s=admin_album&info=1&strid=$strid".$head);
		}
	}
	else
	{
		$admin->check_access('album');
		$album->add_album();
	}
}
if($act=="edit")
{
	$album->edit_album();
	msg("main.php?action=m&m=album&s=admin_album&info=2&menu=$_GET[menu]&catid=$_GET[catid]");
}

if (!empty($_GET['deid'])&&is_numeric($_GET['deid']))	
	$album->del_album($_GET['deid']);


$tpl->assign("album_custom_cat",$admin->get_custom_cat_list(6,0));
if (!empty($_GET['catid']))
	$tpl->assign("de",$album->album_list($_GET['catid']));
else
	$tpl->assign("de",$album->album_list());
	
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
if(!empty($_GET['nohead']))
{
	$output=tplfetch("admin_iframe_album.htm",'','true');
	die;
}
else
{	
	$output=tplfetch("admin_album.htm");
}
?>