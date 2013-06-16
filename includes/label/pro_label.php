<?php
function pro($ar)
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
		$catid=$ar['catid'];
		$ptype=$ar['ptype'];
		
		if($dpid)
			$scl=" and b.province='$dpid' ";
		if($dcid)
			$scl=" and b.city='$dcid' ";
		if(is_numeric($rec))
			$scl.=" and a.statu='$rec'";
		else
			$scl.=" and a.statu=1";
		if(!empty($comp))
			$scl.=" and a.userid=$comp ";
		if(!empty($catid))
			$scl.=" and a.catid=$catid ";
		if(!empty($ptype))
			$scl.=" and a.ptype=$ptype ";
		$sql="SELECT a.id,a.pname,a.userid,a.price,a.uptime,a.con,b.user,b.company FROM ".PRO." a ,".USER." b 
		WHERE a.userid=b.userid  $scl ORDER BY uptime DESC LIMIT 0,$limit";
		$db->query($sql);
		while($k=$db->fetchRow())
		{
			if(file_exists($config['webroot']."/uploadfile/comimg/small/".$k['id'].".jpg"))
				$k['img']=$config['weburl']."/uploadfile/comimg/small/".$k['id'].".jpg";
			else
				$k['img']=$config['weburl']."/image/default/nopic.gif";
			$pro[]=$k;
		}
		//==================================================
		$tpl->assign("config",$config);
		$tpl->assign("pro",$pro);
	}
	return $tpl->fetch($ar['temp'].'.htm',$flag);
}
?>