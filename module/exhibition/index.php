<?php
//=================================
useCahe();
$flag=md5($dpid.$dcid.$config["temp"].$_COOKIE["langtw"]);
if(!$tpl->is_cached("exhibition_index.htm",$flag))
{
	$nowtime=strtotime(date("Y-m-d H:i:s"));
	$sql="select * from ".EXHIBIT." where statu=1 and is_rec=1 and etime>=$nowtime order by stime asc limit 0,8";
	$db->query($sql);
	$re=$db->getRows();
	$tpl->assign("exhibition",$re);
	//===================
	$sql="select * from ".SHOWROOM." order by id desc limit 0,3";
	$db->query($sql);
	$re=$db->getRows();
	$tpl->assign("room",$re);
}
$tpl->assign("current","exhibition");
include_once("footer.php");
$out=tplfetch("exhibition_index.htm",$flag);
?>