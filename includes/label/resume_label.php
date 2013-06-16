<?php
function resume($ar)
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
		if(!empty($userid))
			$buid=$userid;
		$sql="select a.*,b.catname from ".RESUME." a left join ".HRCAT." b on b.id=a.catid where 1 $scl order by a.time desc limit $limit";
		$db->query($sql);
		$re=$db->getRows();
		//==================================================
		$tpl->assign("config",$config);
		$tpl->assign("resume",$re);
	}
	return $tpl->fetch($ar['temp'].'.htm',$flag);
}
?>
