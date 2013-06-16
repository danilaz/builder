<?php
/*
 *Powered by b2bbuilder
 *Copright http://www.b2b-builder.com
 *Auter:Brad zhang
 *Date:2008-11-7
 *Des:产品类别页面，已做缓存处理
 */
useCahe();
$flag=md5($dpid.$dcid.$config["temp"].$_COOKIE["langtw"]);
if(!$tpl->is_cached("products_index.htm",$flag))
{	
	$sql="SELECT * FROM ".PCAT." WHERE catid<9999 ORDER BY nums asc,char_index";
    $db->query($sql);
	$re=$db->getRows();
	foreach($re as $key=>$v)
	{
		 $re[$key]["sub"]=readsubcat($v["catid"]);
	}
	$tpl->assign("cat",$re);
}
$tpl->assign("current","product");
include_once("footer.php");
//================================================================================
$out=tplfetch("products_index.htm",$flag);
$tpl->assign("out",$out);
$sql="SELECT * FROM ".PCAT." WHERE catid<9999 ORDER BY nums asc,char_index";
$db->query($sql);
$re=$db->getRows();
foreach($re as $key=>$v)
{
	 $re[$key]["sub"]=readsubcat($v["catid"]);
}
$tpl->assign("cat",$re);
tplfetch("shop.htm",null,true);
?>