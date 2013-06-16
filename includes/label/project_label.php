<?php
function project($ar)
{
	global $db,$cache,$cachetime,$config,$buid,$tpl;
	useCahe();
	$flag=md5(implode(",",$ar));
	$tmpdir=$config['webroot']."/templates/".$config['temp']."/label/".$ar['temp'].".htm";
	if(file_exists($tmpdir))
		$tpl->template_dir = $config['webroot']."/templates/".$config['temp']."/label/";
	else
		$tpl->template_dir = $config['webroot']."/templates/default/label/";
	$ar['temp']=empty($ar['temp'])?'project_default':$ar['temp'];
	if(!$tpl->is_cached($ar['temp'].".htm",$flag))
	{	
		$limit=$ar['limit'];
		$tj=$ar['rec'];
		$pic=$ar['pic'];
		
		if($tj)
			$sub_sql=" and state=1";
		if($pic)
			$sub_sql.="and pictures!=''";
		$sql="select id,userid,projecttitle,uptime,region,pictures from ".PROJECT." where 1 $sub_sql  
			order by uptime desc limit 0,$limit";
		$db->query($sql);
		$re=$db->getRows();
	
		//==================================================
		$tpl->assign("config",$config);
		$tpl->assign("project",$re);
	}
	return $tpl->fetch($ar['temp'].'.htm',$flag);

}
?>