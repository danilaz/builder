<?php
function exhibition($ar)
{
	global $db,$cache,$cachetime,$config,$buid,$tpl;
	useCahe();
	$flag=md5(implode(",",$ar));
	$tmpdir=$config['webroot']."/templates/".$config['temp']."/label/".$ar['temp'].".htm";
	if(file_exists($tmpdir))
		$tpl->template_dir = $config['webroot']."/templates/".$config['temp']."/label/";
	else
		$tpl->template_dir = $config['webroot']."/templates/default/label/";
	$ar['temp']=empty($ar['temp'])?'exhibition_default':$ar['temp'];
	if(!$tpl->is_cached($ar['temp'].".htm",$flag))
	{	
		$limit=$ar['limit'];
		$recom=$ar['rec'];//是否调用推荐的展会
		$img=$ar['img'];  //img
		$country=$ar['country'];  //国家
		$nowtime=time();
		$sub_sql=NULL;
		if(!empty($recom))
			$sub_sql.=" and is_rec=1";
		if(!empty($img))
			$sub_sql.=" and pic !=''";
		if(!empty($country)&&$country=='cn')
			$sub_sql.=" and country like 'China%'";
		elseif(!empty($country)&&$country=='other')
			$sub_sql.=" and country not like 'China%'";
			
		$sql="select id,stime,etime,addTime,organizers,contractors,contact,tel,showroom,city,addr,con,title,year(FROM_UNIXTIME(stime)) as years,month(FROM_UNIXTIME(stime)) as months,day(FROM_UNIXTIME(stime)) as days,day(FROM_UNIXTIME(etime)) as enddays,pic from ".EXHIBIT."  where statu=1 $sub_sql order by id desc limit $limit";
		$db->query($sql);
		$re=$db->getRows();
		//==================================================
		$tpl->assign("config",$config);
		$tpl->assign("exhibition",$re);
	}
	return $tpl->fetch($ar['temp'].'.htm',$flag);

}
?>