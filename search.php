<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");
//===================================================================
if(!empty($_GET['stype'])&&is_numeric($_GET['stype']))
       $stype=$_GET['stype'];
else
       $stype=2;
 if($_GET['m'] == 'demand') $m = 'demand';
else $m = 'offer'; 
 $tpl->assign("stype",$stype); 
 $tpl->assign("m",$m); 
 
$flag=md5($stype.$dpid.$dcid);
useCahe();
if(!$tpl->is_cached("search.htm",$flag))
{
    //地区列表
	$tpl->assign("country",country_list());
	include_once("lang/".$config['language']."/company_type_config.php");
	//会员组
    $sql="select * from ".USERGROUP;
	$db->query($sql);
	$re=$db->getRows(); 
    $tpl->assign("usergroup",$re);
	//以上公用类别
	if($stype==1)
	{
	   //产品行业
	   $sql="select * from ".OCAT." where catid<9999 order by nums asc";
	   $db->query($sql);
	   $re=$db->getRows(); 
       $tpl->assign("infocat",$re);
	   //产品类型
	   $tpl->assign("infotype",$infoType);
	   //=====
	   if($m=='demand') $tpl->assign("current","demand"); 
	   else $tpl->assign("current","offer");
	}
	if($stype==2)
	{
	   //产品行业
	   $sql="select * from ".PCAT." where catid<9999 order by nums asc";
	   $db->query($sql);
	   $re=$db->getRows(); 
       $tpl->assign("procat",$re);
	   //产品类型
	   $tpl->assign("trade_type",$trade_type);
	   //=====
	   $tpl->assign("current","product");
	}
	if($stype==3)
	{
	   //会员行业
	   $sql="select * from ".COMPANYCAT." where catid<9999 order by nums asc";
	   $db->query($sql);
	   $re=$db->getRows(); 
       $tpl->assign("comcat",$re);
	   //企业类型
	   $tpl->assign("comtype",$companyType);
	   //=====
	   $tpl->assign("current","company");
	}
	include_once("footer.php");
}
$tpl->display("search.htm",$flag);
?>