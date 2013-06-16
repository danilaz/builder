<?php
//===========公告页========================
$id=empty($_GET['id'])?NULL:$_GET['id'];
$nt=strtotime(date("Y-m-d"));
$sql="select * from ".NOTICE." where endtime>$nt order by sort";
$db->query($sql);
$notlist=$db->getRows();
$tpl->assign("noticlist",$notlist);

if(empty($id))
	$id=$notlist[0]['id'];
$sql="select * from ".NOTICE." where id='$id'";
$db->query($sql);
$re=$db->fetchRow();
$tpl->assign("noticecontent",$re);
//========================================
include_once("footer.php");
$out=tplfetch("detail.htm");
?>