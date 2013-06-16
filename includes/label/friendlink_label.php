<?php
function friendlink($ar)
{
	global $db,$cache,$cachetime,$config,$buid,$tpl;
	useCahe();
	$flag=md5(implode(",",$ar));
	$tmpdir=$config['webroot']."/templates/".$config['temp']."/label/".$ar['temp'].".htm";
	if(file_exists($tmpdir))
		$tpl->template_dir = $config['webroot']."/templates/".$config['temp']."/label/";
	else
		$tpl->template_dir = $config['webroot']."/templates/default/label/";
	$ar['temp']=empty($ar['temp'])?'friendlink_default':$ar['temp'];
	if(!$tpl->is_cached($ar['temp'].".htm",$flag))
	{
		$sub_sql=NULL;
		if(!empty($dpid))
			$sub_sql=" and province='$dpid' and (city='' or city is NULL) ";
		if(!empty($dcid))
			$sub_sql=" and city='$dcid' ";
		if(empty($dpid)&&empty($dcid))
			$sub_sql=" and ((city='' and province='') or (city is NULL and province is NULL))";
		$sql="select
			url,name,log from ".LINK." a 
		  where
			published=1 and tj=1 and log!='' $sub_sql order by orderid asc";
		$db->query($sql);
		$piclist=$db->getRows();
		//----------------------------------------------------
		$sql="select
			url,name,log from ".LINK." a 
		  where
			published=1 and tj=1 and log='' $sub_sql order by orderid asc";
		$db->query($sql);
		$textlist=$db->getRows();
		//==================================================
		$tpl->assign("config",$config);
		$tpl->assign("textlist",$textlist);
		$tpl->assign("piclist",$piclist);
	}
	return $tpl->fetch($ar['temp'].'.htm',$flag);

}
?>