<?php
/*
 * Powered by http://www.b2b-builder.com
 * Copright:B2Bbuilder
 * Auter:brad zhang
 * Date:2008-12-31
 */
include_once("config/usergroup.php");
include_once("lang/$config[language]/company_type_config.php");
include_once("includes/page_utf_class.php");
//=====================================
$id=isset($_GET["id"])?$_GET["id"]:NULL;
$key=!empty($_GET["key"])?strtolower(trim($_GET["key"])):NULL;
$firstRow=!empty($_GET["firstRow"])?$_GET["firstRow"]:NULL;
$totalRows=!empty($_GET["totalRows"])?$_GET["totalRows"]:NULL;
//---------信息列表---------
$sql=NULL;
if(!empty($_GET['province']))
	$sql=" and province='$_GET[province]'";
if(!empty($dpid))
	$sql=" and province='$dpid'";
if(!empty($dcid))
	$sql=" and city='$dcid'";
if($id)
	$sql.="and catid like '%,$_GET[id]%'";
if(!empty($key))
	$sql.=" and lower(company) like '%".trim($key)."%' ";
if(!empty($_GET['ct']))
	$sql.=" and ctype='$_GET[ct]' ";
//--------------
$sql="SELECT 
company,main_pro,userid,user,ctype,tel,contact,turnover,province,city,country,staff_num,logo,video,ifpay,addr,registered_capital
	FROM ".USER." WHERE ifpay>1 $sql order by rank desc,ifpay desc,point desc,regtime desc "; 
//--------
$page = new Page;
$page->listRows=20;
$page->url=$config['weburl'];
if(!$page->__get('totalRows'))
{
	$db->query($sql);
	$page->totalRows = $db->num_rows();
}
$sql .= "  limit ".$page->firstRow.", ".$page->listRows;
//---------
$db->query($sql);
$coml=$db->getRows();
foreach($coml as $key=>$v)
{
	$ifpay=$v['ifpay'];
	if(!empty($group[$ifpay]['minilogo']))
		$coml[$key]['user_type']="<img height=20 src='".$group[$ifpay]['minilogo']."' alt='".$group[$ifpay]['name']."' >";
	else
		$coml[$key]['user_type']='['.$group[$ifpay]['name'].']';
		
	$sqlo="select flag from ".COUNTRY." where id='".$v['country']."'";
	$db->query($sqlo);
	$coml[$key]['country']=$db->fetchField('flag');
}
$infos['list']=$coml;
$infos['pages']=$page->prompt();
$tpl->assign("info",$infos);
//-----------
if($id)
{
	$db->query("SELECT * FROM ".COMPANYCAT." WHERE catid='$id'");
	$cat=$db->fetchRow();
	$tpl->assign("current_cat",$cat['cat']);
}
//----------
function get_com_sub_cat($cid)
{
	if(is_numeric($cid))
	{
		global $db;
		$s=$cid."00";
		$b=$cid."99";
		$db->query("SELECT * FROM ".COMPANYCAT." WHERE catid>=$s and catid<=$b and isindex='1' ORDER BY nums ASC");
		return $db->getRows();
	}
}
//------------
if(isset($_GET['province']))
	$tpl->assign("prov",get_province($_GET["province"]));
$tpl->assign("subcat",get_com_sub_cat($id));
$tpl->assign("current","company");
$tpl->assign("companyType",$companyType);
//===================================
include_once("footer.php");
$out=tplfetch("company_list.htm",$flag);
?>