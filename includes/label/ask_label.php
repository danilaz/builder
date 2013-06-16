<?php
function ask($ar)
{
	global $config,$db,$tpl;
	useCahe();
	$flag=md5(implode(",",$ar));
	$ar['temp']=empty($ar['temp'])?'notice_default':$ar['temp'];
	$tmpdir=$config['webroot']."/templates/".$config['temp']."/label/".$ar['temp'].".htm";
	if(file_exists($tmpdir))
		$tpl->template_dir = $config['webroot']."/templates/".$config['temp']."/label/";
	else
		$tpl->template_dir = $config['webroot']."/templates/default/label/";
	if(!$tpl->is_cached($ar['temp'].".htm",$flag))
	{	
		$limit=$ar['limit'];
		if(!empty($catid))
			$scl.=" and a.catid=$catid ";
		if(!empty($uid))
			$scl.=" and a.userid=$uid ";
		
		$sql="SELECT a.*,b.cat FROM ".QUESTION." a ,".PCAT." b 
		WHERE a.catid=b.catid  $scl  ORDER BY a.uptime DESC LIMIT $limit";
		$db->query($sql);
		$ask=$db->getRows();
		//==================================================	
		$tpl->assign("config",$config);
		$tpl->assign("ask",$ask);
	}
	return $tpl->fetch($ar['temp'].'.htm',$flag);
}
?>