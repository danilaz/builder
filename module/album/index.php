<?php
/*
* powered by b2bbuilder
* Coprighty http://www.b2b-builder.com
* Auter:brad zhang;
*/
//=======================================
$sub_sql = NULL;
if(isset($dpid)||isset($dcid))
{
	$dpid?$sub_sql.=" and d.province='$dpid' ":"";
	$dcid?$sub_sql.=" and d.city='$dcid' ":"";
}

if(isset($_GET['id']) && $_GET['id']>0)
{
	$sql = "select a.*,d.userid,d.company,d.city,d.province from ".CUSTOM_CAT." a, ".USER." d 
	where a.sys_cat='$_GET[id]' and a.userid=d.userid and a.type=6 $sub_sql order by a.tj";
}
else
{
	$sql = "select a.*,d.userid,d.company,d.city,d.province from ".CUSTOM_CAT." a, ".USER." d 
	where a.userid=d.userid and a.type=6 $sub_sql order  by a.tj";
}

//-------------------------------
include_once("includes/page_utf_class.php");
$page = new Page;
$page->listRows=16;
$page->url=$config['weburl'];
if (!$page->__get('totalRows'))
{
	$db->query($sql);
	$page->totalRows =$db->num_rows();
}
$sql .= "  limit ".$page->firstRow.", ".$page->listRows;
//--------------------------------

$db->query($sql);
$infoList['list']=$db->getRows();
$infoList['page']=$page->prompt();
$tpl->assign("info",$infoList);
//======================================页面底部
$tpl->assign("current","album");
include_once("footer.php");
$out=tplfetch("album_index.htm");
?>