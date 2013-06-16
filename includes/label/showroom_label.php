<?php
function showroom($ar)
{
	global $db,$cache,$cachetime,$config,$buid,$tpl;
	useCahe();
	$flag=md5(implode(",",$ar));
	$tmpdir=$config['webroot']."/templates/".$config['temp']."/label/".$ar['temp'].".htm";
	if(file_exists($tmpdir))
		$tpl->template_dir = $config['webroot']."/templates/".$config['temp']."/label/";
	else
		$tpl->template_dir = $config['webroot']."/templates/default/label/";
	$ar['temp']=empty($ar['temp'])?'showroom_default':$ar['temp'];
	if(!$tpl->is_cached($ar['temp'].".htm",$flag))
	{
		$limit=$ar['limit'];
		$recom=$ar['rec'];//是否调用推荐的展馆
		$img=$ar['img'];  //img展会图片
		$nowtime=time();
		$sub_sql=NULL;
		if(!empty($recom))
			$sub_sql.=" and is_rec=1";
		if(!empty($img))
			$sub_sql.=" and show_room_pic !=''";
		if(empty($limit))
			$limit=5;
		$sql="select * from ".SHOWROOM." where 1 $sub_sql limit $limit";
		$db->query($sql);
		$re=$db->getRows();
		//==================================================
		$tpl->assign("config",$config);
		$tpl->assign("showroom",$re);
	}
	return $tpl->fetch($ar['temp'].'.htm',$flag);

}
?>