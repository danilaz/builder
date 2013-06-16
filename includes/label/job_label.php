<?php
function job($ar)
{
	global $cache,$cachetime,$dpid,$dcid,$config,$db,$tpl;
	useCahe();
	$flag=md5(implode(",",$ar));
	$tmpdir=$config['webroot']."/templates/".$config['temp']."/label/".$ar['temp'].".htm";
	if(file_exists($tmpdir))
		$tpl->template_dir = $config['webroot']."/templates/".$config['temp']."/label/";
	else
		$tpl->template_dir = $config['webroot']."/templates/default/label/";
	$ar['temp']=empty($ar['temp'])?'pro_default':$ar['temp'];
	if(!$tpl->is_cached($ar['temp'].".htm",$flag))
	{
		$limit=$ar['limit'];
		$rec=$ar['rec'];
		$comp=$ar['comid'];
	
		if(empty($limit))
			$limit=10;
		if($dpid)
			$scl=" and b.province='$dpid' ";
		if($dcid)
			$scl=" and b.city='$dcid' ";
		if(!empty($rec))
			$scl.=" and a.statu=2 ";
		if(!empty($comp))
			$scl.=" and a.userid='$comp' ";
	
		$sql="select a.*,b.company from ".ZP." a ,".USER." b where a.userid=b.userid $scl order by uptime desc limit $limit";
		$db->query($sql);
		$j=$db->getRows();
		//==================================================
		$tpl->assign("config",$config);
		$tpl->assign("jobs",$j);
	}
	return $tpl->fetch($ar['temp'].'.htm',$flag);
}
?>