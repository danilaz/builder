<?php
function video($ar)
{
	global $config,$db,$tpl,$cache,$cachetime;
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
		$leng=$ar['leng'];
		$tj=$ar['rec'];
		if($tj!="")
			$subsql=" and tj='$tj' ";
		else
			$subsql=NULL;
			
		$sql="select video_id,userid,user,name,video_url,img_url,time
			  from ".VIDEO." WHERE fb=1 $subsql order by video_id desc limit 0,$limit";
		$db->query($sql);
		$re=$db->getRows();
	}
	
	$tpl->assign("config",$config);
    $tpl->assign("video",$re);
	return $tpl->fetch($ar['temp'].'.htm',$flag);
}
?>