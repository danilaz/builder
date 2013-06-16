<?php
include_once("includes/page_utf_class.php");
//=========================================
$key=!empty($_GET["key"])?trim($_GET["key"]):NULL;
$firstRow=!empty($_GET["firstRow"])?$_GET["firstRow"]:NULL;
$totalRows=!empty($_GET["totalRows"])?$_GET["totalRows"]:NULL;
$sub_sql=NULL;

if(!empty($_GET['key']))
	$sub_sql.=" and (title like '%$key%' or cat like '%$key%')";
if(!empty($_GET['years']))
	$sub_sql.=" and year(FROM_UNIXTIME(stime))='$_GET[years]'";
if(!empty($_GET['months']))
	$sub_sql.=" and month(FROM_UNIXTIME(stime))='".$_GET['months']."'";
if(!empty($_GET['city']))
	$sub_sql.=" and city like '%".$_GET['city']."%'";
if(!empty($_GET['sroom']))
	$sub_sql.=" and showroom='".$_GET['sroom']."'";
if(!empty($_GET['id'])&&$_GET['id']==2)
	$sub_sql.=" and country='China'";
if(!empty($_GET['id'])&&$_GET['id']==3)
	$sub_sql.=" and country!='China'";
if(!empty($_GET['showtime'])||!empty($_GET['endshowtime']))
{
	$st=empty($_GET['showtime'])?0:strtotime($_GET['showtime']);
	$et=empty($_GET['endshowtime'])?0:strtotime($_GET['endshowtime']);
	$sub_sql.=" and ( etime>=$st and etime<=$et)";
}
else
	$sub_sql.=" and etime>=".time();
	
$sql="select * from ".EXHIBIT." where statu=1 $sub_sql order by stime asc";
//---------------
$page = new Page;
$page->listRows=10;
$page->url=$config['weburl'].'/';
if (!$page->__get('totalRows')){
	$db->query($sql);
	$page->totalRows = $db->num_rows();
}
$sql .= "  limit ".$page->firstRow.",10";
//----------------
$db->query($sql);
$re["page"]=$page->prompt();
$re["list"]=$db->getRows();
$tpl->assign("exhibition",$re);
//----------------
$sql="select * from ".SHOWROOM." order by id desc limit 0,3";
$db->query($sql);
$re=$db->getRows();
$tpl->assign("sroom",$re);

//==================
$tpl->assign("current","exhibition");
include_once("footer.php");
$out=tplfetch("exhibition_list.htm");
?>