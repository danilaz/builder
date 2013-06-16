<?php
/**
 * Email:b2bbuilder@qq.com
 * Auther:Brad
 * 2008,7,17
 */
include_once("lang/".$config['language']."/company_type_config.php");
//===================================================================
$id=!empty($_GET['id'])?$_GET['id']:NULL;
$ifpay=!empty($_GET['ifpay'])?$_GET['ifpay']:NULL;
$key=!empty($_GET['key'])?trim($_GET['key']):NULL;
$catType=!empty($_GET['catType'])?trim($_GET['catType']):NULL;
$firstRow=!empty($_GET['firstRow'])?$_GET['firstRow']:NULL;
$totalRows=!empty($_GET['totalRows'])?$_GET['totalRows']:NULL;
$sub_sql=$guide=$pcat=NULL;

if(!empty($_GET['province']))
	$sub_sql=" and u.province='$_GET[province]'";
if(!empty($dpid))
	$sub_sql=" and u.province='$dpid'";
if(!empty($dcid))
	$sub_sql=" and u.city='$dcid'";
if(!empty($ifpay))
	$sub_sql=" and ifpay>2";
if(is_numeric($id))
{
	$cat=readCat($id,1);
	if(isset($cat['pcat']['catid']))
		$pcat=" <a href='$config[weburl]/?m=demand&s=demand_list&id=".$cat['pcat']['catid']."'>".$cat['pcat']['cat']."</a> &raquo; ";
	$guide=$pcat.$cat['cat'];

	$cid=strlen($id);
	$sub_sql.=" and left(a.catid,$cid)='$id' ";
}
if(!empty($_GET['catType']))
	$sub_sql.= " and a.type='".$_GET['catType']."' ";
//-----------------------
include_once("includes/page_utf_class.php");
$page = new Page;
$page->listRows=20;
$page->url=$config['weburl'];
if(!empty($key))
{
	$guide.="('$key')";
	$sub_sql.=" and (a.keywords like '%$key%' or a.title like '%$key%')";
}

//$sql="SELECT a.id,a.type,a.title,a.con,a.userid,a.user,a.uptime,a.rank,a.pic,a.country,a.province,a.city,a.company,c.flag FROM  ".$config['table_pre']."demand"." a left join ".COUNTRY." c on a.country=c.id WHERE a.statu>0 $sub_sql ORDER BY a.rank desc,a.ifpay desc,a.uptime DESC";
$sql="SELECT a.id,a.type,a.title,a.con,a.userid,a.user,a.uptime,a.rank,a.pic,u.country,u.province,u.city,u.company,c.flag FROM  
  ".$config['table_pre']."demand"." a 
  left join ". $config['table_pre'] ."user u on a.userid = u.userid 
  left join ".COUNTRY." c on u.country=c.id
  WHERE a.statu>0 $sub_sql ORDER BY a.rank desc,a.ifpay desc,a.uptime DESC";

if (!$page->__get('totalRows'))
{
	$db->query($sql);
	$page->totalRows = $db->num_rows();
}
$sql .= "  limit ".$page->firstRow.", ".$page->listRows;
//-----------------
$db->query($sql);
$demand=$db->getRows();
//print_r($demand);
$infoList['list']=$demand;
$infoList['page']=$page->prompt();
//-----------------
$tpl->assign("info",$infoList);
$tpl->assign("num",$page->totalRows);
if(!isset($cat['cat']))
	$cat['cat']=$key?$key:$guide;
$tpl->assign("current_cat",$cat['cat']);
$tpl->assign("subcat",readsubcat($id,'demandcat','all'));
$tpl->assign("infoType",$infoType);
$tpl->assign("current","demand");
//===================================================================
include_once("footer.php");
$out=tplfetch("demand_list.htm");
?>