<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");
//==================================
if(isset($_POST["linkname"]))//审请新的链接
{
	$sql="insert into ".LINK." 
	 (name,url,log,province,city)
	  values
	 ('$_POST[linkname]','$_POST[url]','$_POST[email]','$dpid','$dcid')";
	$re=$db->query($sql);
	if($re)
		header("Location:change_link.php?type=1");
	exit();
}

useCahe();
$flag=md5($dpid.$dcid.$config["temp"].$_COOKIE["langtw"]);
if(!$tpl->is_cached("change_link.htm",$flag))
{
	$sub_sql=NULL;
	if(isset($dpid))
		$sub_sql=" and province='$dpid' ";
	if(isset($dcid))
		$sub_sql=" and city='$dcid' ";
	$sql="select url,name,log from ".LINK." where published=1 $sub_sql order by log desc,orderid asc";
	$db->query($sql);
	$link=$db->getRows();
	$tpl->assign("link",$link);
	//===================================
	include_once("footer.php");
}
//##======================
//-----------------------
$sql="select * from ".WEBCONGROUP;
$db->query($sql);
$con_groups = $db->getRows();
$tpl->assign("con_groups",$con_groups);

$sql="select * from ".WEBCON." where con_statu=1  order by con_no asc";
$db->query($sql);
$all_web = $db->getRows();
$tpl->assign("all_web",$all_web);
//-----------------------
$tpl->display("change_link.htm",$flag);
?>