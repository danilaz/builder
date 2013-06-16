<?php
//============================================
$tpl->assign("cat",get_comcat());
//==============================职业类别
$sql="select id,catname from ".HRCAT." order by posid";
$db->query($sql);
$hrcat=$db->getRows();
$tpl->assign("hrcat",$hrcat);
include_once("module/job/lang/".$config['language']."/lang_hr_config.php");
include_once("module/job/lang/".$config['language']."/index.php");
	$tpl->assign("hrmoney",$hrmoney);
	$tpl->assign("job_type",$job_type);
	$tpl->assign("hrdropdate",$hrdropdate);
//===============================搜索列表
$query=NULL;
if(!empty($_GET["cid"]))
	$query.=" and b.scatid = '$_GET[cid]'";

if(!empty($_GET["sid"]))
{
	$query.=" and b.catid ='$_GET[sid]'";
}
if(!empty($_GET["comcat"]))
	$query.=" and a.catid like '$_GET[comcat]%'";
if(isset($_GET["pro"]))
	$query.=" and b.	properties = '$_GET[pro]'";
if($_GET["jobdate"]!="0")
{	
	$date=date("Y-m-d");
	$time=strtotime($date);
	if($_GET["jobdate"]==1)
	{
		$query.=" and b.uptime>='$date'";
	}
	if($_GET["jobdate"]==2)
	{
		$date=date("Y-m-d",$time-3600*24);
		$query.=" and b.uptime>='$date'";
	}
	if($_GET["jobdate"]==3)
	{
		$date=date("Y-m-d",$time-3600*24*2);
		$query.=" and b.uptime>='$date'";
	}
	if($_GET["jobdate"]==4)
	{
		$date=date("Y-m-d",$time-3600*24*7);
		$query.=" and b.uptime>='$date'";
	}
	if($_GET["jobdate"]==5)
	{
		$date=date("Y-m-d",$time-3600*24*30);
		$query.=" and b.uptime>='$date'";
	}
	if($_GET["jobdate"]==6)
	{
		$date=date("Y-m-d",$time-3600*24*60);
		$query.=" and b.uptime>='$date'";
	}
}
if(!empty($_GET["keyword"]))
{
	$query.=" and b.title like '%$_GET[keyword]%'";
}
$sql="select b.*,a.company,province,city from ".ZP." b,".USER." a  where a.userid=b.userid $query order by b.uptime desc";
//===========================================
	include_once("includes/page_utf_class.php");
	$page = new Page;
	$page->listRows=15;
	$page->url=$config['weburl'];
	if (!$page->__get('totalRows')){
		$db->query($sql);
		$anum=$db->fetchRow();
		$page->totalRows = $db->num_rows();
	}
	$sql .= "  limit ".$page->firstRow.", ".$page->listRows;
//===============================
$db->query($sql);
$re["list"]=$db->getRows();
$re["page"]=$page->prompt();
$tpl->assign("re",$re);

$tpl->assign("current","job");
include_once("footer.php");
$out=tplfetch("job_list.htm");
?>