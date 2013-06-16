<?php
/*
* powered by b2bbuilder
* Coprighty http://www.b2b-builder.com
* Auter:brad zhang;
*/
include_once("lang/".$config['language']."/company_type_config.php"); 
//======================================
useCahe();
$flag=md5($dpid.$dcid.$config["temp"].$_COOKIE["langtw"]);
if(!$tpl->is_cached("demand_index.htm",$flag))
{	
	//------------
	$db->query("SELECT * FROM ".OCAT." WHERE catid<9999 ORDER BY nums,char_index asc");
	$re=$db->getRows();
	foreach($re as $key=>$v)
	{
		$re[$key]["sub"]=readsubcat($v["catid"],'demand');
	}
	$tpl->assign("cat",$re);
}
$tpl->assign("infoType",$infoType); 
$tpl->assign("current","demand");
include_once("footer.php");
$out=tplfetch("demand_index.htm",$flag);
?>