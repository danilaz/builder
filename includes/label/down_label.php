<?php
function down($ar)
{
	global $cache,$cachetime,$dpid,$dcid,$config,$db,$tpl;
	useCahe();
	$flag=md5(implode(",",$ar));
	$ar['temp']=empty($ar['temp'])?'user_default':$ar['temp'];
	$tmpdir=$config['webroot']."/templates/".$config['temp']."/label/".$ar['temp'].".htm";
	if(file_exists($tmpdir))
		$tpl->template_dir = $config['webroot']."/templates/".$config['temp']."/label/";
	else
		$tpl->template_dir = $config['webroot']."/templates/default/label/";
	if(!$tpl->is_cached($ar['temp'].".htm",$flag))
	{	
		$limit=$ar['limit'];
		$rec=$ar['rec'];
		$spointer=empty($ar['start_pointer'])?0:$ar['start_pointer'];
		if($rec)
			$scl.=" where state='$rec'";
		$spointer=empty($ar['start_pointer'])?0:$ar['start_pointer'];	
		$sql="SELECT downname,id from ".down." $scl ORDER BY create_time DESC LIMIT $spointer,$limit";
		$db->query($sql);
		$down=$db->getRows();
		//==================================================
		$tpl->assign("config",$config);
		$tpl->assign("down",$down);
	}
	return $tpl->fetch($ar['temp'].'.htm',$flag);

}
?>