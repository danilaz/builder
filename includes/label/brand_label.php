<?php
function brand($ar)
{
	global $config,$db,$tpl;
	useCahe();
	$flag=md5(implode(",",$ar));
	$tmpdir=$config['webroot']."/templates/".$config['temp']."/label/".$ar['temp'].".htm";
	if(file_exists($tmpdir))
		$tpl->template_dir = $config['webroot']."/templates/".$config['temp']."/label/";
	else
		$tpl->template_dir = $config['webroot']."/templates/default/label/";
	$ar['temp']=empty($ar['temp'])?'brand_default':$ar['temp'];
	if(!$tpl->is_cached($ar['temp'].".htm",$flag))
	{	
		$limit=$ar['limit'];
		$rec=$ar['rec'];
		$img=$ar['pic'];
		if(is_numeric($rec))
			$scl=" and statu='$rec'";
		else
			$scl=" and statu=1";
		if(!empty($img))
			$scl.=" and pic !=''";
		$sql="SELECT * FROM ".BRAND." WHERE 1 $scl ORDER BY nums asc LIMIT 0,$limit";
		$db->query($sql);
		$re=$db->getRows();
		//==================================================
		$tpl->assign("config",$config);
		$tpl->assign("brand",$re);
	}
	return $tpl->fetch($ar['temp'].'.htm',$flag);
}
?>