<?php
function province($ar)
{
	global $cache,$cachetime,$dpid,$dcid,$config,$db,$tpl;
	useCahe();
	$flag=md5(implode(",",$ar));
	$tmpdir=$config['webroot']."/templates/".$config['temp']."/label/".$ar['temp'].".htm";
	if(file_exists($tmpdir))
		$tpl->template_dir = $config['webroot']."/templates/".$config['temp']."/label/";
	else
		$tpl->template_dir = $config['webroot']."/templates/default/label/";
	$ar['temp']=empty($ar['temp'])?'province_default':$ar['temp'];
	
	if(!$tpl->is_cached($ar['temp'].".htm",$flag))
	{
		$sql="select province_id,province from ".PROVINCE." order by sx asc";
		$db->query($sql);
		$re=$db->getRows();
		foreach($re as $key=>$v)
		{
			$sql="select city_id,city from ".CITY." WHERE province_id='$v[province_id]'";
			$db->query($sql);
			$re[$key]["city"]=$db->getRows();
		}
		//==================================================
		$tpl->assign("config",$config);
		$tpl->assign("province",$re);
	}
	return $tpl->fetch($ar['temp'].'.htm',$flag);
}
?>