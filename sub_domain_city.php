<?php
/**
 * Email:zyfang1115@163.com
 * Auter:Brad
 * 2008,7,17
 */
//============================
include_once("includes/global.php");
include_once("includes/smarty_config.php");
useCahe();
$flag=$config["temp"];
if(!$tpl->is_cached("sub_domain_city.htm"))
{	
	$sql="select domain,con,con2 from ".DOMAIN." where isopen=1 and dtype=1 group by con";
	$db->query($sql);
	$re=$db->getRows();
	foreach($re as $key=>$v)
	{
		$sql="select domain,con,con2 from ".DOMAIN." where isopen=1 and dtype=1 and con='$v[con]' and con2!=''";
		$db->query($sql);
		$city=$db->getRows();
		$re[$key]['city']=$city;
	}
	$tpl->assign("prov",$re);
	include_once("footer.php");
}
$tpl->display("sub_domain_city.htm",$flag);
?>
