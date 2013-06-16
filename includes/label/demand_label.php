<?php
function demand($ar)
{
	global $cache,$cachetime,$dpid,$dcid,$db,$config,$tpl;
	useCahe();
	$flag=md5(implode(",",$ar));
	$ar['temp']=empty($ar['temp'])?'demand_default':$ar['temp'];
	$tmpdir=$config['webroot']."/templates/".$config['temp']."/label/".$ar['temp'].".htm";
	if(file_exists($tmpdir))
		$tpl->template_dir = $config['webroot']."/templates/".$config['temp']."/label/";
	else
		$tpl->template_dir = $config['webroot']."/templates/default/label/";
	if(!$tpl->is_cached($ar['temp'].".htm",$flag))
	{
		$limit=$ar['limit'];	//条数
		$tj=$ar['rec'];			//是否推荐
		$catid=$ar['catid'];	//类别ＩＤ
		$type = $ar['otype'];	//类型
		$startrecord=$ar['startrecord'];
		
		if(!empty($dpid))
			$sub_sql=" and province='$dpid' ";
		if(!empty($dcid))
			$sub_sql=" and city='$dcid' ";
		if($type)
			$sub_sql.=" and type='$type'";
		if($tj)
			$sub_sql.=" and statu=2 ";
		else
			$sub_sql.=" and statu>=1 ";
		if($ud)
			$sub_sql.=" and userid=$ud ";
		if($catid)
			$sub_sql.=" and catid like '%$catid%' ";
		if(!empty($startrecord)&&is_numeric($startrecord))
			$sp=$startrecord;
		else
			$sp=0;
		$sql="
			SELECT title,id,userid,user,type,uptime,country,province,city,company,user,con,pic,gg,price FROM ".INFO." 
			WHERE 1 $sub_sql ORDER BY id desc limit $sp,$limit";
		$db->query($sql);
		$re=$db->getRows();  
		//---------------------------------------------------------------------------
		$tpl->assign("config",$config);
		$tpl->assign("demand",$re);
	}
	return $tpl->fetch($ar['temp'].'.htm',$flag);
}
?>