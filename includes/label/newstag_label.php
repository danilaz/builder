<?php
function newstag($ar)
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
		$catlimit=$ar['catlimit'];	//类别数
		$limit=$ar['limit'];		//新闻数
		$catid=$ar['catid'];		//类别ID，为0表示一级类别
		
		if(empty($catlimit))
			$catlimit=5;
		if(empty($limit))
			$limit=5;;
		if(!empty($catid))
			$ssql=" and pid='$catid'";

		$sql="SELECT * from ".NEWSCAT." WHERE ishome=1 $ssql order by nums asc limit $catlimit";//菜单
		$db->query($sql);
		$re=$db->getRows();
		$num=$db->num_rows();
		for($i=0;$i<$num;$i++)
		{
			$sql="SELECT catid from ".NEWSCAT." WHERE ishome=1 and pid='".$re[$i]["catid"]."'";//菜单
			$db->query($sql);
			$rcs=$db->getRows();
			$scatid=$re[$i]["catid"];
			foreach($rcs as $v)
			{
				$scatid=$scatid.','.$v['catid'];
			}
			$sql="SELECT title,ftitle,nid,titlefont,uptime FROM ".NEWSD." WHERE 
				 classid in (".$scatid.") and ispass=1 ORDER BY nid DESC limit $limit";
			$db->query($sql);
			$list=$db->getRows();
			foreach($list as $key=>$val)
			{
				$list[$key]['uptime']=date('m/d',$val['uptime']);
				if($val['titlefont'])
				{
					$st="style='";
					$font=explode('|',$val['titlefont']);	
					$col=array_pop($font);
					if(in_array('b',$font))
						$st.="font-weight:bold;";
					if(in_array('i',$font))
						$st.="font-style:italic;";
					if(in_array('s',$font))
						$st.="text-decoration:line-through;";
					if($col)
					{
						$st.="color:$col";	
					}
					$st.="'";
					$list[$key]['style']=$st;
				}	
			}
			$re[$i]["newsList"]=$list;
		}
		//=======================================================
		$tpl->assign("config",$config);
		$tpl->assign("newstag",$re);
	}
	return $tpl->fetch($ar['temp'].'.htm',$flag);

}
?>