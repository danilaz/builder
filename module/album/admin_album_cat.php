<?php
include_once("lang/".$config['language']."/user_admin/global.php");
include("module/album/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/album/includes/plugin_album_class.php");
include_once("includes/page_utf_class.php");
$album=new album();
//==========================================		
$act=isset($_POST['action'])?$_POST['action']:NULL;
//----------add .edit
if($act=="submit")
{
	$admin->check_access('album_cat');
	$album->add_album_cat(6);
}
else if ($act=="edit")
{
	$album->edit_album_cat(6,$_POST['editid']);
}

//---------delete
if(!empty($deid))
{
	$album->del_album_cat(6,$_GET['deid']);
}

//-----detail
if(isset($_GET['edit']))
{
	$de=$album->get_album_cat_list(6,$_GET['edit']);
	if(strlen($de['sys_cat'])>6)
		$de['scatid']=$de['sys_cat'];
	if(strlen($de['sys_cat'])>4)
		$de['tcatid']=substr($de['sys_cat'],0,6);
	$de['catid']=substr($de['sys_cat'],0,4);
	$tpl->assign("re",$de);
} 
else
	$tpl->assign("re",$album->get_album_cat_list(6,0));

//----------albumecat	
$tpl->assign("cat",$admin->getCatName(ALBUMCAT));
//==================================================		
$tpl->assign("config",$config);
$tpl->assign("lang",$lang);
$output=tplfetch("admin_album_cat.htm")
?>