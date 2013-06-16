<?php
function jobcat($ar)
{
	global $config,$db,$tpl;
	useCahe();
	$flag=md5(implode(",",$ar));
	$tmpdir=$config['webroot']."/templates/".$config['temp']."/label/".$ar['temp'].".htm";
	if(file_exists($tmpdir))
		$tpl->template_dir = $config['webroot']."/templates/".$config['temp']."/label/";
	else
		$tpl->template_dir = $config['webroot']."/templates/default/label/";
	$ar['temp']=empty($ar['temp'])?'cat_default':$ar['temp'];
	if(!$tpl->is_cached($ar['temp'].".htm",$flag))
	{	
		$sql="select id,catname from ".HRCAT." where pid=0 order by posid limit 0,8";
		$db->query($sql);
		$re=$db->getRows();	
		$re=get_value($re);
		$tpl->assign("config",$config);
		$tpl->assign("jobcat",$re);
	}
	return $tpl->fetch($ar['temp'].'.htm',$flag);
}
function get_value($re)
{
	global $config,$db,$tpl;
	foreach($re as $key=>$val)
	{
	   $sql="select id,catname from ".HRCAT." where pid=$val[id] order by posid";
	   $db->query($sql);
	   $res=$db->getRows();
	   $re[$key]['cat']=$res;
	   return $re;
	}
}
?>