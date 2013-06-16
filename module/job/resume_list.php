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
$tpl->assign("degree",$degree);
$tpl->assign("hrdropdate",$hrdropdate);
$tpl->assign("job_type",$job_type);
//===============================搜索列表
$query=NULL;

if(isset($_GET["degree"]) and $_GET["degree"]!=-1)
	$query.=" and a.degree>=$_GET[degree]";
if(isset($_GET["pro"]))
	$query.=" and a.job_type = '$_GET[pro]'";
if(isset($_GET["sex"]))
	$query.=" and a.usex = '$_GET[sex]'";

if($_GET["jobdate"]!="0")
{	
	$date=date("Y-m-d");
	$time=strtotime($date);
	if($_GET["jobdate"]==1)
	{
		$query.=" and a.time>='$date'";
	}
	if($_GET["jobdate"]==2)
	{
		$date=date("Y-m-d",$time-3600*24);
		$query.=" and a.time>='$date'";
	}
	if($_GET["jobdate"]==3)
	{
		$date=date("Y-m-d",$time-3600*24*2);
		$query.=" and a.time>='$date'";
	}
	if($_GET["jobdate"]==4)
	{
		$date=date("Y-m-d",$time-3600*24*7);
		$query.=" and a.time>='$date'";
	}
	if($_GET["jobdate"]==5)
	{
		$date=date("Y-m-d",$time-3600*24*30);
		$query.=" and a.time>='$date'";
	}
	if($_GET["jobdate"]==6)
	{
		$date=date("Y-m-d",$time-3600*24*60);
		$query.=" and a.time>='$date'";
	}
}
$sql="select * from ".RESUME." a  left join ".HRCAT." c on a.scatid=c.id,".USER." b  where a.userid=b.userid and a.statu=1 $query";
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
$out=tplfetch("resume_list.htm");
?>