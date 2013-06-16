<?php
function news($ar)
{
	global $cache,$cachetime,$dpid,$dcid,$config,$db,$tpl;
	useCahe();
	if(!empty($ar['labelid'])&&file_exists($config['webroot']."/config/label/news_$ar[labelid].php"))
	{
		include($config['webroot']."/config/label/news_$ar[labelid].php");
		$ar['temp']='defind_news_'.$ar['labelid'];
		$ar['limit']=$news_label['num'];
		$ar['catid']=$news_label['catid'];
		$ar['titleimg']=$news_label['image'];
		$ar['user']=$news_label['from'];
		$ar['order']=$news_label['news_statu'];
	}
	$flag=md5(implode(",",$ar));
	$tmpdir=$config['webroot']."/templates/".$config['temp']."/label/".$ar['temp'].".htm";
	if(file_exists($tmpdir))
		$tpl->template_dir = $config['webroot']."/templates/".$config['temp']."/label/";
	else
		$tpl->template_dir = $config['webroot']."/templates/default/label/";
	$ar['temp']=empty($ar['temp'])?'news_default':$ar['temp'];
	if(!$tpl->is_cached($ar['temp'].".htm",$flag))
	{
		$limit=empty($ar['limit'])?1:$ar['limit'];	        //条数
		$num=empty($ar['num'])?0:$ar['num'];	       	    
		$leng=$ar['leng'];                         			//длина строки
		$keyboard=$ar['keyboard'];                         	//Ключевое слово
		$key=$ar['key'];                         	        //Ключевое слово
		$user=$ar['user'];	  					   			//$user: Независимо от того, чтобы позвонить в Новости
		$uid=$ar['userid'];	                        		//调用ID会员的新闻
		$tj=$ar['rec'];			                    		//是否推荐
		$top=$ar['top']; 									//是否头条
		$catid=$ar['catid'];	                   			//新闻类别ＩＤ
		$catname=$ar['catname'];                   			//类别名
		$img=$ar['img'];		               				//新闻标题图片
		$order=$ar['order'];		           			    //调用方式
		$oth=$ar['oth'];
		$flash=$ar['flash'];								//是否调用flash
		$width=empty($ar['width'])?100:$ar['width'];        //ширина
   	    $height=empty($ar['height'])?100:$ar['height'];     //высота
		
		if(!$user)
			$sql.=" and (a.uid='0' or a.uid is NULL) ";
		if($uid)
			$sql.=" and a.uid='$uid' ";
		
		
		if($catid)
		{
			include_once($config['webroot']."/module/news/includes/news_function.php");
			$ids=get_lowerid($catid);
			if(!empty($ids))
				$sql.=" and b.catid in ($ids) ";
		}
		if($catname)
			$sql.=" and b.cat='$catname'";
			
		if($keyboard)
		{
			$keys=" and ( ";
			$keyboard=explode(',',$keyboard);
			foreach($keyboard as $num=>$val)
			{
				if($num==0)
					$keys.=" a.keyboard like '%$val,%' or a.keyboard='$val'";
				else
					$keys.=" or a.keyboard like '%$val,%' or a.keyboard='$val'";
			}
			$keys.=" )";
			$sql.=$keys;
		}
		if($oth)
			$sql.=" and a.nid!='$oth'";
	 	if($top)
			$sql.=" and a.istop='1'";
		if($tj)
			$sql.=" and a.isrec='1'";
		if($img)
			$sql.=" and a.ispic='1'";
		
		if($order=='onclick')
			$str=" order by a.onclick DESC, a.isrec DESC, a.uptime DESC, a.nid DESC";
		elseif($order=='top')
			$str=" order by a.istop DESC, a.isrec DESC, a.uptime DESC, a.nid DESC";
		elseif($order=='rec')
			$str=" order by a.isrec DESC, a.onclick DESC, a.uptime DESC, a.nid DESC";
		else 
			$str=" order by a.uptime DESC, a.isrec DESC, a.onclick DESC, a.nid DESC";
			
		
		$sql="select a.nid,a.classid,a.title,a.ftitle,a.titleurl,a.titlefont,a.uid,a.uptime,a.smalltext,a.writer,a.source,a.titlepic,b.cat,b.catid  from ".NEWSD." a  left join ".NEWSCAT." b on a.classid=b.catid where ispass=1 $sql $str limit $num,$limit";

		$db->query($sql);
		$re=$db->getRows();
		foreach($re as $key=>$val)
		{
			if($val['uid'])
				$re[$key]['url']=geturl('newsd',$val['uid'],$val['writer'],$val['nid']);
			else
			{
				if(empty($val['titleurl']))
					$re[$key]['url']=$config["weburl"].'/?m=news&s=newsd&id='.$val['nid'];
			    else
					$re[$key]['url']=$val['titleurl'];
			}
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
				$re[$key]['style']=$st;
			}
			
			if($flash)
			{
				@$sst[]=str_replace("'","‘",$val['title']);
				@$ssp[]=$config['weburl'].'/uploadfile/news/big/'.$val['titlepic'];
				@$ssl[]=urlencode($re[$key]['url']);
			}
			
			if(file_exists($config['webroot']."/uploadfile/news/".$val['titlepic']))
			{
				$re[$key]['pic']=$config['weburl']."/uploadfile/news/".$val['titlepic'];
			}
			else
			{
				$re[$key]['pic']=$config['weburl']."/uploadfile/news/0.jpg";
			}
			
			
		}
		if($flash)
	    {
			@$tpl->assign("files",implode("|",$ssp));
			@$tpl->assign("links",implode("|",$ssl));
			@$tpl->assign("texts",implode("|",$sst));
			$tpl->assign("height",$height);
			$tpl->assign("width",$width);
		}
		
		//=======================================================
		$tpl->assign("config",$config);
		$tpl->assign("news",$re);
		$tpl->assign("leng",$leng);
	}
	return $tpl->fetch($ar['temp'].'.htm',$flag);

}
?>