<?php
function newscatnav($ar)
{
	global $cache,$cachetime,$dpid,$dcid,$config,$db,$tpl;
	useCahe();
	$flag=md5(implode(",",$ar));
	$tmpdir=$config['webroot']."/templates/".$config['temp']."/label/".$ar['temp'].".htm";
	if(file_exists($tmpdir))
		$tpl->template_dir = $config['webroot']."/templates/".$config['temp']."/label/";
	else
		$tpl->template_dir = $config['webroot']."/templates/default/label/";
	$ar['temp']=empty($ar['temp'])?'news_default':$ar['temp'];
	if(!$tpl->is_cached($ar['temp'].".htm",$flag))
	{	
		$limit=$ar['limit'];	//条数
		$catid=$ar['catid'];	
		if(empty($limit))
			$limit=5;;
		if(!empty($catid))
			$ssql=" and pid='$catid'";
		else
			$ssql=" and pid='0'";
		$sql="select * from ".NEWSCAT." where ishome=1  $ssql limit 0,$limit";		
		$db->query($sql);
		$re=$db->getRows();
		//=======================================================
		$tpl->assign("config",$config);
		$tpl->assign("newscat",$re);
	}
	return $tpl->fetch($ar['temp'].'.htm',$flag);

}
?>