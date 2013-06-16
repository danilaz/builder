<?php
/*
 * Powered by b2bbuilder 
 * Auther:Brad zhang;
 * Date:2008-11-7
 * Copright:http://www.b2b-builder.com
 * Des:企业类别页面，已做缓存处理
 */
useCahe();
$flag=md5($dpid.$dcid.$config["temp"].$_COOKIE["langtw"]);
if(!$tpl->is_cached("companys_index.htm",$flag))
{	
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
	//==================类别列表
	$db->query("SELECT * FROM ".COMPANYCAT." WHERE catid<=9999 and isindex='1' ORDER BY nums ASC");
	$cat=$db->getRows();
	foreach($cat as $key=>$v)
	{
		$cat[$key]["subcat"]=get_com_sub_cat($v['catid']);
	}
	$tpl->assign("cat",$cat);
}
$tpl->assign("current","company");
include_once("footer.php"); 
$out=tplfetch("companys_index.htm",$flag);
?>