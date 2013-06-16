<?php
function user($ar)
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
		$ifpay=$ar['ifpay'];
		$spointer=empty($ar['start_pointer'])?0:$ar['start_pointer'];
		if($dpid)
			$scl=" and province='$dpid' ";
		if($dcid)
			$scl=" and city='$dcid' ";
		if($rec)
			$scl.=" and tj='$rec'";
			
		if(!empty($ifpay))
			$scl.=" and ifpay='$ifpay' ";
		else
			$scl.=" and ifpay>1 ";
		$sql="SELECT * from ".USER." WHERE company!='' $scl ORDER BY regtime DESC LIMIT $spointer,$limit";
		$db->query($sql);
		$user=$db->getRows();
		foreach($user as $key=>$v)
		{
			if($v['catid'])
			{
				unset($cat);
				$sql="select cat from ".COMPANYCAT." where catid in (0$v[catid]0)";
				$db->query($sql);
				while($k=$db->fetchRow())
					$cat[]=$k['cat'];
				if(!empty($cat))
					$user[$key]['cat']=implode(",",$cat);
			}
		}
		//==================================================
		$tpl->assign("config",$config);
		$tpl->assign("user",$user);
	}
	return $tpl->fetch($ar['temp'].'.htm',$flag);
}
?>