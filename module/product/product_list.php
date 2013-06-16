<?php
include_once("config/usergroup.php");
//====================================
$id=!empty($_GET["id"])?$_GET["id"]:NULL;
$key=!empty($_GET["key"])?trim($_GET["key"]):NULL;
$trade_type=!empty($_GET["trade_type"])?$_GET["trade_type"]:NULL;
$firstRow=!empty($_GET["firstRow"])?$_GET["firstRow"]:NULL;
$totalRows=!empty($_GET["totalRows"])?$_GET["totalRows"]:NULL;
$gifpay=!empty($_GET["ifpay"])?$_GET["ifpay"]:NULL;
$sprice=!empty($_GET["sprice"])?$_GET["sprice"]:NULL;
$eprice=!empty($_GET["eprice"])?$_GET["eprice"]:NULL;
$province=!empty($_GET["province"])?$_GET['province']:NULL;
$orderby=!empty($_GET["orderby"])?$_GET['orderby']:NULL;
$scl=NULL;$guide=NULL;

if(is_numeric($id))
{
	$cat=readCat($id);
	if(isset($cat["pcat"]["catid"]))
		$pcat=" <a href='$config[weburl]/?m=product&s=product_list&id=".$cat["pcat"]["catid"]."'>".$cat["pcat"]["cat"]."</a> &raquo; ";
	else
		$pcat=NULL;
	$guide=$pcat.$cat["cat"];

	$cid=strlen($id);
	$scl=" and left(a.catid,$cid)='$id' ";
	
	if(!empty($cat['brand']))
	{
		$sql="select * from ".BRAND." where id in ( $cat[brand] ) order by nums asc ";
		$db->query($sql);
		$re=$db->getRows();
		$tpl->assign("brand",$re);
	}
	
}
if(isset($dpid)||isset($dcid))
{
	$dpid?$scl.=" and a.province='$dpid' ":"";
	$dcid?$scl.=" and a.city='$dcid' ":"";
}	
if(!empty($_GET['s_catid'])){
	$scl.=" and LOCATE(".trim($_GET['s_catid']).",a.catid)=1 ";//按类别搜索
}
if(!empty($key))
{
	$guide=$key;
	$scl.=" and ( a.keywords like '%$key%' or a.pname like '%$key%' )";
}
if($province)
	$scl.= " and a.province='$province' ";
if(!empty($trade_type))
	$scl.= " and a.trade_type='$trade_type' ";
if(!empty($_GET['brand']))
	$scl.= " and a.pp='".$_GET['brand']."' ";
if($gifpay)
	$scl.=" and a.ifpay='$gifpay' ";
if($sprice)
	$scl.=" and a.price>='$sprice' ";
if($eprice)
	$scl.=" and a.price<='$eprice' ";
	
if($orderby==1)
	$scl.=" order by a.ifpay desc";
elseif($orderby==2)
	$scl.=" order by a.uptime desc";	
elseif($orderby==3)
	$scl.=" order by a.uptime asc";
elseif($orderby==4)
	$scl.=" order by a.price asc";
elseif($orderby==5)
	$scl.=" order by a.price desc";
else
	$scl.=" order by a.rank desc,a.ifpay desc, a.uptime desc";
#################################################
	include_once("includes/page_utf_class.php");
	$page = new Page;
	$page->url=$config['weburl'].'/';
	$page->listRows=12;
	$sql="SELECT 
	a.id,a.catid,a.pname,a.userid,a.user,a.uptime,a.con,a.price,a.unit,a.province,a.city,a.ifpay,a.trade_type,a.freight,b.country,b.company 
	FROM ".PRO." a left join ".USER." b on a.userid=b.userid WHERE a.statu>0 $scl";
	if (!$page->__get('totalRows'))
	{
		$db->query($sql);
		$page->totalRows =$db->num_rows();
	}
	$sql.=" limit ".$page->firstRow.", 12";
//--------------------------------------------------
$db->query($sql);
$prol=$db->getRows();

foreach($prol as $keys=>$v)
{
	$ifpay=!empty($v['ifpay'])?$v['ifpay']:1;
	if(!empty($group[$ifpay]['minilogo']))
		$prol[$keys]['user_type']="<img src='".$group[$ifpay]['minilogo']."' alt='".$group[$ifpay]['name']."' >";
	else
		$prol[$keys]['user_type']="[".$group[$ifpay]['name']."]";
	$prol[$keys]['img'] ="uploadfile/comimg/small/$v[id].jpg";
}
$infoList['list']=$prol;
$infoList['page']=$page->prompt();

$tpl->assign("info",$infoList);
unset($infoList);
if(empty($cat["cat"]))
	$cat["cat"]=!empty($key)?$key:$guide;
$tpl->assign("province",get_province($province));
$tpl->assign("queryurl","&sprice=$sprice&eprice=$eprice&key=$key&ifpay=$gifpay&trade_type=$trade_type&id=$id");

include_once("lang/".$config['language']."/company_type_config.php");
$tpl->assign("trade_type",$trade_type);

$tpl->assign("group",$group);
$tpl->assign("num",$page->totalRows);
$tpl->assign("subcat",readsubcat($id,NULL,'all'));
$tpl->assign("current_cat",$cat["cat"]);
$tpl->assign("current","product");
$tpl->assign("guide",$guide);
include_once("footer.php");
//=====================================================
$out=tplfetch("product_list.htm",$flag);

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