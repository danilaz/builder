<?php
//============================================
include_once("module/job/lang/".$config['language']."/lang_hr_config.php");
include_once("module/job/lang/".$config['language']."/index.php");
include_once("$config[webroot]/includes/page_utf_class.php");
$tpl->assign("hrmoney",$hrmoney);
$tpl->assign("job_type",$job_type);
if(!empty($_GET['id']))
{
	$sql="select b.*,a.company,a.addr,c.catname,ctype from ".ZP." b left join ".USER." a on a.userid=b.userid left join ".HRCAT." c on b.catid=c.id where b.id=$_GET[id]";
	$db->query($sql);
	$re=$db->fetchRow();
	$tpl->assign("job",$re);

    $sql="select a.*,b.catname from ".RESUME." a left join ".HRCAT." b on b.id=a.catid where a.userid='$buid' order by a.time desc";
	$page = new Page;
	$page->listRows=2;
	if (!$page->__get('totalRows')){
		$db->query($sql);
		$page->totalRows = $db->num_rows();
	}
	$sql .= "  limit ".$page->firstRow.",2";
	$db->query($sql);
	$re["list"]=$db->getRows();
	$re["page"]=$page->prompt();
	$tpl->assign("resume",$re);
}

if(!empty($_POST['rid']) and !empty($_POST['id']))
{
	$sql="insert into ".RBOX." (rid,jid,time) values($_POST[rid],$_POST[id],".time().")";
	$db->query($sql);
	header("Location:$config[weburl]/?m=job&s=job_detail&id=$_POST[id]");
}

$tpl->assign("current","job");
include_once("footer.php");
$out=tplfetch("job_detail.htm");
?>