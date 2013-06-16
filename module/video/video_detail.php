<?php
include("module/video/includes/plugin_video_class.php");
//=====================
function video_detail($id)
{
	global $db;
	include_once("includes/tag_inc.php");
	$sql="select * from ".VIDEO." where video_id='$id'";
	$db->query($sql);
	$info=$db->fetchRow();
	$ar=explode('.',$info['video_url']);
	$info['type']=$ar[count($ar)-1];
	$info['keyword']=get_tags($_GET['id'],2);
	return $info;
}

if(!empty($_GET['id']))
{
	$de=video_detail($_GET['id']);
	$tpl->assign("de",$de);
}
//====================
$sql="select * from ".VIDEO." order by rank desc";
$db->query($sql);
$list=$db->getRows();
$tpl->assign("video",$list);

$tpl->assign("current","video");
include("footer.php");
$out=tplfetch("video_detail.htm");
?>