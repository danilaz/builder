<?php
//--------------------------------------------
$firstRow=!empty($_GET["firstRow"])?$_GET["firstRow"]:NULL;
$totalRows=!empty($_GET["totalRows"])?$_GET["totalRows"]:NULL;
$sub_sql=NULL;
if(!empty($_GET['id']))
{
	$sub_sql.=" and a.catid='".$_GET['id']."'";
}
if(!empty($_GET['key']))
	$sub_sql.=" and a.title like '%".$_GET['key']."%'";
if(!empty($_GET['cat'])&&$_GET['cat']!='reward')
	$sub_sql.=" and a.statu='".$_GET['cat']."'";
if(!empty($_GET['cat'])&&$_GET['cat']=='reward')
	$sub_sql.=" and a.reward>0";
//------------------------------------
include_once("includes/page_utf_class.php");
$page = new Page;
$page->listRows=20;
$sql="SELECT a.*,b.cat FROM ".QUESTION." a left join ".PCAT." b  on a.catid=b.catid 
      WHERE  1  $sub_sql order by a.uptime desc";
if (!$page->__get('totalRows'))
{
	$db->query($sql);
	$page->totalRows=$db->num_rows();
}
$sql.= "  limit ".$page->firstRow.", ".$page->listRows;
$db->query($sql);
//------------------------------------
$allan['lists']=$db->getRows();
$allan['pages']=$page->prompt();
$tpl->assign("quest",$allan);
//--------------------------------导航
$lcatid=$guide=$tit=NULL;
if(!empty($_GET['catid']))
	$lcatid=$_GET['catid'];
if(!empty($lcatid))
{
	$a=$lcatid.'00';
	$b=$lcatid.'99';
	$sql="select catid,cat from ".PCAT." where catid>$a and catid<$b";
	$db->query($sql);
	$subcat=$db->getRows();
	$tpl->assign("subc",$subcat);
}
if(strlen($lcatid)>=4)
{
	$acat=substr($lcatid,0,4);
	$sql="select catid,cat from ".PCAT." where catid='$acat'";
	$db->query($sql);
	$pcats=$db->fetchRow();
	if(!empty($pcats['cat']))
	{
		$guide.=" <a href='$config[weburl]/?m=ask&s=ask_list&id=$acat'>".$pcats['cat']."</a> ";
		$tit.=$pcats['cat'].',';
	}
}
if(strlen($lcatid)>=6)
{
	$acat=substr($lcatid,0,6);
	$sql="select catid,cat from ".PCAT." where catid='$acat'";
	$db->query($sql);
	$pcatss=$db->fetchRow();
	if(!empty($pcatss['cat']))
	{
		$guide.=" &raquo; <a href='$config[weburl]/?m=ask&s=ask_list&id=$acat'>".$pcatss['cat']."</a> ";
		$tit.=$pcatss['cat'].',';
	}
}
if(strlen($lcatid)>=8)
{
	$acat=substr($lcatid,0,8);
	$sql="select catid,cat from ".PCAT." where catid='$acat'";
	$db->query($sql);
	$pcatsss=$db->fetchRow();
	if(!empty($pcatsss['cat']))
	{
		$guide.=" &raquo; <a href='$config[weburl]/?m=ask&s=ask_list&id=$acat'>".$pcatsss['cat']."</a> ";
		$tit.=$pcatsss['cat'].',';
	}
}
$tpl->assign("guid",$guide);
//=======================
$tpl->assign("current","ask");
include_once("footer.php");
$out=tplfetch("ask_list.htm");
?>