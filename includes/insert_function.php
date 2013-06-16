<?php
/**
 * Copright :b2bbuilder
 * Powered by :b2bbuilder
 * Auter:brad
 * Date: 2008-11-04
 * Des:非公共免费代码，没有得到b2bbuilder许可，禁止传播，复制。
 */
//===================
include_once("arrcache_class.php");
$cache     = new ArrCache('cache/apidata/');
$cachetime = $config['cacheTime'];//数据调用缓存时间。
//===================
function insert_label($ar)
{
	global $tpl,$config;
	$type=$ar['type'];
	include_once("label/".$type."_label.php");
	$con=$type($ar);
	$tpl->caching=false;
	$tpl->template_dir = $config['webroot']."/templates/".$config['temp']."/";
	return $con;
}
/**
 *二级城市域名调用．
 */
function insert_getSubCity($ar)
{	
	global $cache,$cachetime,$config;
	$limit=$ar['limit'];
	if(strlen($str=$cache->str_begin($ar,$cachetime))<=0)
	{
		if(!empty($config['baseurl']))
		{
			 global $db;
			 $sql="select * from ".DOMAIN." where isopen=1 and dtype=1 limit 0,$limit";
			 $db->query($sql);
			 $re=$db->getRows();
			 $str=NULL;
			 foreach($re as $v)
			 {
				$url='http://'.$v['domain'].'.'.$config['baseurl'];
				$str.='<a href="'.$url.'">';
				if($v['con2'])
					$str.=$v['con2'];
				else
					$str.=$v['con'];
				$str.='</a>&nbsp;';
			 }
		 }
	}
	$cache->str_end($str);
	return $str;
}

function insert_bbs($ar)
{
	global $cache,$cachetime;
	if(strlen($str=$cache->str_begin($ar,$cachetime))<=0)
	{	
		$limit=empty($ar['limit'])?5:$ar['limit'];
		$leng=empty($ar['leng'])?20:$ar['leng'];
		$url=empty($ar['url'])?NULL:$ar['url'];
		
		$db=new dba($ar['dbhost'],$ar['dbuser'],$ar['dbpass'],$ar['dbname']);
		$re=$db->query("SET character_set_connection=utf8, character_set_results=utf8, character_set_client=binary");
		if($config['bbsrec'])
			$tsql=" where displayorder>=1 ";
		else
			$tsql="";
		$db->query("select subject,tid from cdb_threads $tsql order by tid desc limit 0,$limit");
		$str=NULL;
		while($k=$db->fetchRow())
		{
			$str.="<a href='$url/viewthread.php?tid=$k[tid]'>".csubstr($k['subject'],0,$leng)."</a><br />";
		}
		
	}
	$cache->str_end($str);
	return $str;
}
//===================幻灯片调用
function insert_getSlide($ar)
{
	global $cache,$cachetime;
	if(strlen($str=$cache->str_begin($ar,$cachetime))<=0)
	{
		global $db,$config;
		$sql="SELECT
			title,newsid,pic FROM ".NEWS."
		  WHERE
			tj=4 and fb=1  and userid is NULL ORDER BY newsid DESC limit 0,4";//幻灯片
		$db->query($sql);
		$re=$db->getRows();
		$i=0;
		foreach($re as $v)
		{
			if($i>0)
			{
				$l.="|".$config['weburl']."/?m=news&s=newsd&id=".$v['newsid'];
				$t.="|".addslashes($v['title']);
				$p.="|".$config['weburl']."/uploadfile/newsimg/sizec/".$v['pic'];
			}
			else
			{
				$l.=$config['weburl']."/?m=news&s=newsd&id=".$v['newsid'];
				$t.=addslashes($v['title']);
				$p.=$config['weburl']."/uploadfile/newsimg/sizec/".$v['pic'];
			}
			$i++;
		}
		$str="<script>";
			$str.="var url='".$config['weburl']."';";
			$str.="var focus_width=".$ar['width'].";";
			$str.="var focus_height=".$ar['height'].";";
			$str.="var text_height=".$ar['textheight'].";";
			$str.="var pics='". $p."';";
			$str.="var links='". $l."';";
			$str.="var texts='". $t."';";
		$str.="</script>";
		$str.="<script src='$config[weburl]/script/slide.js'></script>";
	}
	$cache->str_end($str);
	return $str;
}
//========================
function insert_getPlayer($ar)
{
	global $cache,$cachetime;
	if(strlen($str=$cache->str_begin($ar,$cachetime))<=0)
	{
		global $db;
		$height=$ar['height'];
		$width=$ar['width'];
	    $sql="select video_id,userid,name,video_url,img_url,time
			  from ".VIDEO." WHERE fb=1 and tj=1 order by video_id desc limit 0,1";
		$db->query($sql);
		$k=$db->fetchRow();
		if(!empty($k['video_id']))
		{
		  $str='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" height="'.$height.'" width="'.$width.'"><param name="movie" value="'.$k['video_url'].'" /><param name="quality" value="high" /><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="true" /><embed src="'.$k['video_url'].'" allowScriptAccess="always" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowfullscreen="true" height="'.$height.'" width="'.$width.'" /></object>';
	   }
	}
	$cache->str_end($str);
	return $str;
}
//=========================
function insert_getVieo($ar)
{
	global $cache,$cachetime;
	if(strlen($str=$cache->str_begin($ar,$cachetime))<=0)
	{	
		$limit=$ar['limit'];
		$leng=$ar['leng'];
		$tj=$ar['rec'];
		
		global $db;
		
		if($tj!="")
			$subsql=" and tj='$tj' ";
		else
			$subsql=NULL;
			
		$sql="select video_id,userid,user,name,video_url,img_url,time
			  from ".VIDEO." WHERE fb=1 $subsql order by video_id desc limit 0,$limit";
		$db->query($sql);
		while($k=$db->fetchRow())
		{
		$str.=" <a href='".geturl('videod',$k['userid'],$k['user'],$k['video_id'])."' title='$k[title]' target='_blank'>".
				csubstr($k['name'],0,$leng).
				"</a><br>";
		}
	}
	$cache->str_end($str);
	return $str;
}
//公司调用
function insert_getUser($ar)
{
	global $cache,$cachetime,$dpid,$dcid;
	$ar[$dpid]=$dpid;
	$ar[$dcid]=$dcid;
	if(strlen($str=$cache->str_begin($ar,$cachetime))<=0)
	{	
		global $db,$config;
		
		$field=$ar['field'];
		$filter=$ar['filter'];
		$limit=$ar['limit'];
		$leng=$ar['leng'];
		$logo = $ar['logo'];
		$groupid=$ar['ugroupid'];
		$cid=$ar['catid'];

		$heig=$ar['height'];
		if (empty($heig))
             $heig=80;
		$width=$ar['width'];
		if (empty($width))
             $width=100;

		if(!empty($dpid))
			$sql=" and province='$dpid' ";
		if(!empty($dcid))
			$sql=" and city='$dcid' ";

		if(!empty($groupid))
			$sql=" and ifpay='$groupid' ";

		if(!empty($cid))
			$sql=" and catid like '%,$cid%'";
				
		if($filter=="new")
			$sql.=" order by regtime desc ";
		elseif($filter=="old")
			$sql.=" order by regtime asc ";
		elseif($filter=="rand")
			$sql.=" order by rand() ";
		elseif($filter=="rec")
			$sql.=" and tj=1 order by rank desc";
		elseif($filter=="star")
			$sql.=" and tj=2 order by rank desc";
		else
			$sql.=" order by regtime desc ";

		$sql="select userid,user,logo,$field from ".USER." where company!='' and ifpay>1 $sql limit 0,".$limit;
		$db->query($sql);
		$fileds=explode(",",$field);
		while($k=$db->fetchRow())
		{
			$str.="<li>";
					if(!empty($logo))
					{
						if(empty($k['logo']))
							$str.="<a href='".geturl('',$k['userid'],$k['user'],'',$k['company'])."' title='' target='_blank'><img width=".$width." height=".$heig." src='$config[weburl]/image/default/nopic.gif'><br />";
						else
				     		$str.="<a href='".geturl('',$k['userid'],$k['user'],'',$k['company'])."' title='' target='_blank'><img width=\"".$width."\" height=\"".$heig."\" src='$config[weburl]/uploadfile/userimg/$k[logo]'><br />";
					}
					else
					{
						$str.="<a href='".geturl('',$k['userid'],$k['user'],'',$k['company'])."' title='' target='_blank'>";
					}
				   foreach($fileds as $key=>$v)
				   {
					 	$str.=csubstr($k[$v],0,$leng)."&nbsp;";
				   }
			$str.="</a></li>";
		}
	}
	$cache->str_end($str);
	return $str;
}
//展会调用
function insert_getExh($ar)
{
	global $cache,$cachetime,$config,$dpid,$dcid;
	$ar[$dpid]=$dpid;
	$ar[$dcid]=$dcid;
	
	if(strlen($str=$cache->str_begin($ar,$cachetime))<=0)
	{	
		$limit=$ar['limit'];
		$leng=$ar['leng'];//标题长度
		$recom=$ar['rec'];//是否调用推荐的展会
		$pic=$ar['img'];//是否调用展示图片
		$wid=$ar['width'];//图片宽度
		$hei=$ar['height'];//图片高度
		$cid=$ar['catid'];//分类ID
		$time=$ar['time'];//时间
		global $db;
		$sub_sql=NULL;
		if(empty($wid))
			$wid=80;
		if(empty($hei))
			$hei=60;
		if (!empty($recom))
		    $sub_sql.=" and is_rec=1";
		if (!empty($pic))
		    $sub_sql.=" and pic!=''";
		$sql="select * from ".EXHIBIT." where statu=1 $sub_sq1 order by id desc limit 0,$limit";
		$db->query($sql);
        $re=$db->getRows();
		$str='';
		foreach($re as $k)
		{  
			if($pic)
				$p='<img src="'.$config['weburl'].'/uploadfile/exhibitimg/'.$k['pic'].'.jpg" width="'.$wid.'" height="'.$hei.'" ><br/>';
			else
				$p='';
				$str.=" <li>".$p."<a href='$config[weburl]/?m=exhibition&s=exhibition_detail&id=$k[id]' title='$k[title]' target='_blank'>".csubstr($k['title'],0,$leng)."</a>";
			if (!empty($time))
				$str.='<span>['.dateformat($k['addTime']).']</span>';
			$str.="</li>";
		}
	}
	$cache->str_end($str);
	return $str;
}
//专题调用
function insert_getSpecial($ar)
{
	global $cache,$cachetime,$db,$config;
	if(strlen($str=$cache->str_begin($ar,$cachetime))<=0)
	{	
		$limit=isset($ar['limit'])?$ar['limit']:5;//条数
		$leng = $ar['leng'];//长度
		$sql="select * from ".SPE." where 1 order by `order` asc limit 0,$limit";//专题详情
		$db->query($sql);
		$re=$db->getRows();
		foreach($re as $v)
		{
			$str.="<li>";
			$str.="<a href='$config[weburl]/?m=special&s=spd&name=$v[file_name]'>".csubstr($v['name'],0,$leng)."</a>";
			$str.="</li>";
		}
	}
	$cache->str_end($str);
	return $str;
}
//产品调用

function insert_getDemands($ar)
{
	global $cache,$cachetime,$dpid,$dcid;
	$ar['is_demand'] = true;
	return insert_getOffers($ar); 
	return $str;
} 

function insert_getOffers($ar)
{
	global $cache,$cachetime,$dpid,$dcid;
	$ar[$dpid]=$dpid;
	$ar[$dcid]=$dcid;
	if(strlen($str=$cache->str_begin($ar,$cachetime))<=0)
	{	
		$limit=$ar['limit'];	//条数
		$tj=$ar['rec'];			//是否推荐
		$catid=$ar['catid'];	//类别ＩＤ
		$leng = $ar['leng'];	//长度
		$type = $ar['type'];	//类型
		$img = $ar['img'];		//
		$mqu = $ar['marquee'];
		$height=$ar['height'];
		$ud=$ar['userid'];
		$startrecord=$ar['pointer'];//记录起始条位置
		$time=$ar['pubtime'];//发布时间
		$country=$ar['country'];//国家
		$provinc=$ar['province'];//地区
		$cflag=$ar['countryflag'];//国旗
		$flag_id=md5(implode(".",$ar));
		$col_count = isset($ar['col_count']) ? $ar['col_count'] : 4; 
		
		global $db,$config;$sp=0;
		if(!empty($dpid))
			$sub_sql=" and a.province='$dpid' ";
		if(!empty($dcid))
			$sub_sql=" and a.city='$dcid' ";
		if($type)
			$sub_sql.=" and a.type='$type'";
		if($tj)
			$sub_sql.=" and a.statu=2 ";
		if($ud)
			$sub_sql.=" and a.userid=$ud ";
		if($catid)
			$sub_sql.=" and a.catid=$catid ";
		if(!empty($startrecord)&&is_numeric($startrecord))
			$sp=$startrecord;
		if($ar['is_demand']) 
		 {
		  $db_table = $config['table_pre']."demand";
		  $obj = 'demand'; 
		 } else {
		  $db_table = INFO;
		  $obj = 'offer';
		 }
		$sql="
			SELECT a.title,a.id,a.userid,a.user,a.type,a.uptime,a.country,a.province,a.city,a.pic FROM ".$db_table." a 
			WHERE a.statu>0 $sub_sql ORDER BY a.uptime desc limit $sp,$limit";
	
		$db->query($sql);
		$re=$db->getRows();
		//if($mqu=="true")
		 $str='<table width="100%"  border="0" cellpadding="0" cellspacing="0">'; 
		$i = 1;
	//	$re = array_merge($re,$re);
		foreach($re as $k)
		{
    $href = geturl($obj.'_detail',$k['userid'],$k['user'],$k['id'],'',$obj); 
    $src_ar = explode(',',$k['pic']);
    //print_r($src_ar);
    foreach($src_ar as $s)
      if($s > 0)
        $src1 = $s;
   // echo $src1.'-';
    //$src1 = $src_ar[0];
    if(!empty($src1)) $src = $config['weburl'].'/uploadfile/zsimg/size_small/'.$src1.'.jpg';
		else $src = $config['weburl'].'/image/default/nopic.gif'; 
		$postc = strlen($k['title']) > $leng ? '...' : '';
		$title = csubstr($k['title'],0,$leng).$postc; 
		$desc = $k['title'];
		
		if($type != 2)
		 {
		 if($i == 1) $str.= '<tr>';
		 } else $str.= '<tr>'; 
		 
		  if($type != 2) {
		    $str.= ' <td valign="top" style="margin:2px;padding:2px;width:80px;" align="center">'; 
        $str.= ' <a href="'. $href .'" title="'.$desc.'"><img style="border: 1px solid #ccc; padding: 1px" src="'.$src.'" onerror="this.src=\''.$config['weburl'].'/image/default/nopic.gif\'" width="100"></a>';
        $str.= ' <br />';
      } else {
        $str.= ' <td>'; 
        //$str.= ' <img src="'.$config['weburl'].'/image/default/'.$obj.'_2.gif"> ';
      }
      $str.= ' <a href="'. $href .'" title="'.$desc.'">'. $title .'</a>';
 
     
     $str.= ' </td> ';
		 if($type != 2) { 
		  if($i == $col_count) {
		    $str.= '</tr>';
		    $i = 1;
	 	  } else $i++;
	   }
	 	 else $str.= '</tr>'; 
		}
		if($type != 2) {
		 if($i != $col_count) {
		   $str.= '</tr>';
		 }
		}
		 $str.='</table>'; 
	}
//	print_r($re);
	$cache->str_end($str);
	return $str;
}
//友情连接
function insert_getFriendLink($ar)
{
	global $cache,$cachetime,$dpid,$dcid,$db;
	
	if(strlen($str=$cache->str_begin($ar=array('link',$dpid,$dcid),$cachetime))<=0)
	{	
		$sub_sql=NULL;
		if(!empty($dpid))
			$sub_sql=" and province='$dpid' and (city='' or city is NULL) ";
		if(!empty($dcid))
			$sub_sql=" and city='$dcid' ";
		if(empty($dpid)&&empty($dcid))
		{
			$sub_sql=" and ((city='' and province='') or (city is NULL and province is NULL))";
		}
		$sql="select url,name,log from ".LINK." a  where published=1 and tj=1 and log!='' $sub_sql order by orderid asc";
		$db->query($sql);
		while($k=$db->fetchRow())
		{
			$str.='<a href="'.$k['url'].'" alt="'.$k['name'].'" target="_blank" ><img src="'.$k['log'].'"></a>';
		}
		$sql="select url,name,log from ".LINK." a where published=1 and tj=1 and log='' $sub_sql order by orderid asc";
		$db->query($sql);
		while($k=$db->fetchRow())
		{
			$str.=' <a href="'.$k['url'].'" alt="'.$k['name'].'" target="_blank" >'.$k['name'].'</a> |';
		}
	}
	$cache->str_end($str);
	return $str;
}
//新闻调用
function insert_getNews($ar)
{
	global $cache,$cachetime,$dpid,$dcid,$config;
	$ar[$dpid]=$dpid;
	$ar[$dcid]=$dcid;
	if(strlen($str=$cache->str_begin($ar,$cachetime))<=0)
	{	
		global $db;
		$limit=$ar['limit'];	//条数
		$user=$ar['user'];	   //$user:是否调用会员新闻
		$uid=$ar['userid'];	   //调用ID会员的新闻
		$tj=$ar['recommend'];	//是否推荐
		$catid=$ar['catid'];	//新闻类别ＩＤ
		$leng = $ar['leng'];	//长度
		$istime =$ar['istime'];   //是否取时间
		if(!empty($catid))
			$sql=" and a.classid in ($catid) ";
		if(!$user)
			$sql.=" and a.uid=0 ";
		else
			$sql.=" and a.uid='$uid' ";
		if($tj)
			$sql.=" and a.isrec='1'";
			
		$sql="select a.nid,a.classid,a.title,a.ftitle,a.titleurl,a.titlefont,a.uid,a.uptime,a.smalltext,a.writer,a.source,a.titlepic,b.cat,b.catid  from ".NEWSD." a  left join ".NEWSCAT." b on a.classid=b.catid where ispass=1 $sql order by nid desc limit 0,$limit";
		$db->query($sql);
		while($k=$db->fetchRow())
		{
			if($user==true)
				$a=geturl('newsd',$k['uid'],$k['writer'],$k['nid']);
			else
				$a=$config["weburl"].'/?m=news&s=newsd&id='.$k['nid'];
			$str.='<li><a href="'.$a.'" target="_blank" title="'.$k['title'].'">'.csubstr($k['ftitle'],0,$leng).'
			</a>';
			if(!empty($istime))
				$str.='<span>'.dateformat($k['uptime']).'</span>';
			$str.='</li>';
		}
	}
	$cache->str_end($str);
	return $str;
}
//产品调用
function insert_getPro($ar)
{
	global $cache,$cachetime,$dpid,$dcid,$config;
	$ar[$dpid]=$dpid;
	$ar[$dcid]=$dcid;
	if(strlen($str=$cache->str_begin($ar,$cachetime))<=0)
	{	
		$limit=$ar['limit'];
		$leng=$ar['leng'];
		$img=$ar['img'];
		$rec=$ar['rec'];
		$comp=$ar['comid'];
        $catid=$ar['catid'];
		$uid=$ar['userid'];
		$startrecord=$ar['pointer'];//记录起始位置
		global $db;
		
		if($dpid)
			$scl=" and province='$dpid' ";
		if($dcid)
			$scl=" and city='$dcid' ";
		
		if(is_numeric($rec))
			$scl.=" and statu='$rec'";
		else
			$scl.=" and statu=1";
		if(!empty($comp))
			$scl.=" and userid=$comp ";
		if(!empty($catid))
			$scl.=" and catid=$catid ";
		if(!empty($uid))
			$scl.=" and userid=$uid ";
		if(!empty($startrecord)&&is_numeric($startrecord))
			$sp=$startrecord;
		else
			$sp=0;
		$sql="SELECT id,pname,userid,user,price FROM ".PRO." WHERE 1 $scl ORDER BY uptime DESC LIMIT $sp,$limit";
		$db->query($sql);
		while($k=$db->fetchRow())
		{
			$k['price']=number_format($k['price'],2);
			if(!empty($img))
			{
				if(file_exists($config['webroot']."/uploadfile/comimg/small/".$k['id'].".jpg"))
					$img="<img src='".$config['weburl']."/uploadfile/comimg/small/".$k['id'].".jpg'/><br>";
				else
					$img="<img src='".$config['weburl']."/image/default/nopic.gif'/><br>";
				$price="<span class='bmoney'>".$config['money'].$k['price']."</span>";
			}
			else
			{
				$img=NULL;
				$price="<span class='smoney'>(".$config['money'].$k['price'].")</span>";
			}
			
			$url=geturl('prod',$k['userid'],$k['user'],$k['id']);
			$str.="<li><a href='$url' target='_blank'>".$img.csubstr($k['pname'],0,$leng).$price."</a></li>";
		}
	}
	$cache->str_end($str);
	return $str;
}
/**
 *根据ＴＡＧ调用相关内容．
 */
function insert_getTags($ar)
{
	global $cache,$cachetime,$dpid,$dcid;
	$ar['dpid']=$dpid;$ar['dcid']=$dcid;
	if(strlen($str=$cache->str_begin($ar,$cachetime))<=0)
	{
		global $db,$config;;
		$tag=$ar['tag'];
		$type=$ar['type'];
		$leng=$ar['leng'];
		$limit=empty($ar['limit'])?10:$ar['limit'];
		
		if(!empty($tag))
		{
			$tagar=explode(",",$tag);
			$i=0;
			$tg=" and ( ";
			foreach($tagar as $v)
			{
				if($i==0)
					$tg.=" tagname='$v'";
				else
					$tg.=" or  tagname='$v'";
				$i++;
			}
			$tg.=")";
		}
		$sql="select tid from ".CTAGS." where 1 $tg and type='$type'";
		if($type==1)
			$sql="select id,pname as title,userid,user from ".PRO." where id in ($sql) and statu>0";
		if(type==2)
			$sql="select id,title,userid,user from ".INFO." WHERE id in ($sql) and statu>0";
		if($type==3)
			$sql="select nid as id,title from ".NEWSD." where nid in ($sql)";
		if($type==4)
			$sql="select id,title from ".EXHIBIT." where id in ($sql)";
		if($type==5)
			$sql="select video_id as id,name as title,userid,user from ".VIDEO." where id in ($sql)";
		$sql.=" order by id desc limit 0,$limit";
		$db->query($sql);
		$re=$db->getRows();
		foreach($re as $v)
		{
			if($type==1)
			{
				if(file_exists($config['webroot']."/uploadfile/comimg/small/$v[id].jpg"))
					$img="$config[weburl]/uploadfile/comimg/small/$v[id].jpg";
				else
					$img="$config[weburl]/image/default/nopic.gif";
				$str.="<li><a href='".geturl('prod',$v['userid'],$v['user'],$v['id'])."'>
				<img src='$img'>
				<br>".csubstr($v['title'],0,$leng)."</a></li>";
			}
			if($type==2)
				$str.="<li><a href='".geturl('infod',$v['userid'],$v['user'],$v['id'])."'>".csubstr($v['title'],0,$leng)."</a></li>";
			if($type==3)
			{
				$str.="<li><a href='$config[weburl]/?m=news&s=newsd&id=$v[id]'>".csubstr($v['title'],0,$leng)."</a></li>";
			}
			if($type==4)
			{
				$str.="<li><a href='$config[weburl]/?m=exhibition&s=exhibition_detail&id=$v[id]'>".csubstr($v['title'],0,$leng)."</a></li>";
			}
			if($type==5)
				$str.="<li><a href='".geturl('prod',$v['videod'],$v['user'],$v['id'])."'>".csubstr($v['title'],0,$leng)."</a></li>";
		}
	}
	$cache->str_end($str);
	return $str;
}
/**
 * 获取热门tag
 * $type=1,2,3,4
 */
function insert_hotTags($ar)
{
	global $cache,$cachetime,$dpid,$dcid;
	$ar['dpid']=$dpid;$ar['dcid']=$dcid;
	if(strlen($str=$cache->str_begin($ar,$cachetime))<=0)
	{
		global $db,$config;;
		$type=$ar['type'];
		$limit=empty($ar['limit'])?10:$ar['limit'];
		
		$sql="select distinct(a.tagname) from ".TAGS." a, ".CTAGS." b where a.tagname=b.tagname and b.type='$type' order by a.total desc limit 0, $limit";
		$db->query($sql);
		$re=$db->getRows();
		foreach($re as $v)
		{
			if($type==1)
				$a='?m=product&s=product_list&';
			if($type==2)
				$a='?m=offer&s=offer_list&';
			if($type==3)
				$a='?m=news&s=news_list&';
			if($type==4)
				$a='?m=exhibition&s=exhibition_list&';
			$str.="<a href='$config[weburl]/".$a."key=".urlencode($v['tagname'])."'>$v[tagname]</a> ";
		}
	}
	$cache->str_end($str);
	return $str;
}
//取得任何内容的标签
//================================
function insert_getConTags($ar)
{
	global $cache,$cachetime,$dpid,$dcid;
	$ar['dpid']=$dpid;$ar['dcid']=$dcid;
	if(strlen($str=$cache->str_begin($ar,$cachetime))<=0)
	{	
		global $db,$config;
		$tid=$ar['tid'];
		$type=$ar['type'];
		$re=array();
		$sql="select * from ".CTAGS." where tid='$tid' and type='$type'";
		$db->query($sql);
		$re=$db->getRows();
		foreach($re as $v)
		{
			if($type==1)
				$a='?m=product&s=product_list&';
			if($type==2)
				$a='?m=offer&s=offer_list&';
			if($type==3)
				$a='?m=news&s=news_list&';
			if($type==4)
				$a='?m=exhibition&s=exhibition_list&';
			$str.="<li><a href='$config[weburl]/".$a."key=".urlencode($v['tagname'])."'>$v[tagname]</a></li>";
		}
	}
	$cache->str_end($str);
	return $str;
}
//公告调用
function insert_getNotice($ar)
{
	global $cache,$cachetime;
	if(strlen($str=$cache->str_begin($ar,$cachetime))<=0)
	{	
		global $db,$config;
		$limit=$ar['limit'];	//条数
		$leng = $ar['leng'];	//标题长度
        $height= $ar['height'];	//高度
		$mqu = $ar['marquee']; //滚动
		$flag_id=md5(implode(".",$ar));
		if(empty($limit))
			$limit=5;
		if(empty($leng))
            $leng=80;
		$nt=strtotime(date("Y-m-d"));
		$sql="SELECT * from ".NOTICE." where endtime>$nt order by sort limit 0,".$limit;
		$db->query($sql);
		$re=$db->getRows();
		if($mqu=="true")
		   $str='<div id='.$flag_id.' ><ul>';
		else
		   $str='';
		foreach($re as $v)
		{
			 if($v['type']=="1")
			{
			      $str.='<li><a href="'.$config['weburl'].'/?m=announcement&s=detail&id='.$v['id'].'" target="_blank" title="'.$v['title'].'" >'.csubstr($v['title'],0,$leng).'</a></li>';
			}
			 else
			{
				  $conurl=str_replace("<p>",'',$v['content']);
                  $conurl=str_replace("</p>",'',$conurl);
			      $str.='<li><a href="'.$conurl.'" target="_blank" title="'.$v['title'].'" >'.csubstr($v['title'],0,$leng).'</a></li>';
			}
		}
		if($mqu=="true")
		{
			$str.='</ul></div>';
			$str.="<script src='$config[weburl]/script/marquee.js' type='text/javascript'></script>
				  <script>
			      new Marquee('$flag_id',0,1,'100%',$height,10,4000,5000);
				  </script>
				  ";
		}
	}
	$cache->str_end($str);
	return $str;
}
//焦点资讯幻灯样式4
function insert_newsflash2($ar)
{
    global $cache,$cachetime,$db,$config;
	$width=$ar['pwidth'];//宽度
    $height=$ar['pheight'];//高度
	$nums=$ar['limit'];//图片数
	if(empty($nums))
		$nums=5;
	if($ar['rec'])
		$sqls=" and isrec=1";
		
    if(strlen($str=$cache->str_begin($ar,$cachetime))<=0)
	{
	   $sql="select * from ".NEWSD." where ispass=1 and ispic=1 $sqls order by uptime desc limit 0,".$nums;
	   $db->query($sql);
       $re=$db->getRows();
	   $recs=$db->num_rows();
	   $sst=$ssp=$ssl=array();
	   foreach($re as $v)
	   {
		    $sst[]=str_replace("'","‘",$v['title']);
			$ssp[]=$config['weburl'].'/uploadfile/newsimg/sizec/'.$v['pic'];
			$ssl[]=urlencode($config['weburl']."/?m=news&s=newsd&id=".$v['newsid']);
	    }
       $str="<script>
var swf_width=$width;
var swf_height=$height;
var files='".implode("|",$ssp)."';
var links='".implode("|",$ssl)."';
var texts='".implode("|",$sst)."';
document.write('<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" width=\"'+ swf_width +'\" height=\"'+ swf_height +'\">');
document.write('<param name=\"movie\" value=\"$config[weburl]/image/default/hot_new.swf\"><param name=\"quality\" value=\"high\">');
document.write('<param name=\"menu\" value=\"false\"><param name=wmode value=\"opaque\">');
document.write('<param name=\"FlashVars\" value=\"bcastr_file='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'\">');
document.write('<embed src=\"$config[weburl]/image/default/hot_new.swf\" wmode=\"opaque\" FlashVars=\"bcastr_file='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'& menu=\"false\" quality=\"high\" width=\"'+ swf_width +'\" height=\"'+ swf_height +'\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" />'); document.write('</object>'); 
</script>";
       }
   $cache->str_end($str);
   return $str;
}
//获取今日发布 产品，产品，资讯,展会 数量
function insert_getnums($ar)
{
    global $cache,$cachetime,$db,$config;
	$mtype=$ar['type'];//0为所有，1为产品，2为产品，3为资讯，4为展会
    $stype=$ar['subtype'];//如果type为2，则subtype可以为1为销售，2为求购，3为合作，4为转让
	$all=$ar['isall'];//总计，不是今日更新的
	if(strlen($str=$cache->str_begin($ar,3600*24))<=0)
	{
		if($mtype==1)
		{
			if (!empty($all))
				$sql="select count(*) as pros from ".PRO;
			else
				 $sql="select count(*) as pros from ".PRO." where date(uptime)=curdate()";
			$db->query($sql);
			$rs=$db->fetchRow();
			$str=$rs['pros'];
		}
		elseif($mtype==2)
		{
			if(!empty($all))
			{
				if($stype)
				   $sql="select count(*) as offers from ".INFO." where type='$stype'";
				else
				   $sql="select count(*) as offers from ".INFO;
			}
			else
			{
				if($stype)
				   $sql="select count(*) as offers from ".INFO." where type='$stype' and date(uptime)=curdate()";
				else
				   $sql="select count(*) as offers from ".INFO." where  date(uptime)=curdate()";
			}
			$db->query($sql);
			$rs=$db->fetchRow();
			$str=$rs['offers'];
			   
		}
		elseif($mtype==3)
		{
			if(!empty($all))
				$sql="select count(*) as newss from ".NEWSD;
			else
				$sql="select count(*) as newss from ".NEWSD." where date(uptime)=curdate()";
			$db->query($sql);
			$rs=$db->fetchRow();
			$str=$rs['newss'];
		}
		elseif($mtype==4)
		{
			if (!empty($all))
				$sql="select count(*) as exhibs from ".EXHIBIT;
			else
				$sql="select count(*) as exhibs from ".EXHIBIT." where date(addTime)=curdate()";
			$db->query($sql);
			$rs=$db->fetchRow();
			$str=$rs['exhibs'];
		}
   }
   $cache->str_end($str);
   return $str;
}
//========================
function insert_getUserPlayer($ar)
{
	global $cache,$cachetime;
	if(strlen($str=$cache->str_begin($ar,$cachetime))<=0)
	{
		global $db,$config;
		$height=$ar['height'];
		$width=$ar['width'];
		$userid=$ar['userid'];
	    $sql="select video_id,name,video_url,img_url
  			  from ".VIDEO." WHERE userid='$userid' and user_tj=1 limit 0,1";
	    $db->query($sql);
		$k=$db->fetchRow();
		if($k['video_id']){
			$ar=explode('.',$k['video_url']);
			$k['type']=$ar[count($ar)-1];
		    if(substr($k['video_url'],0,4)=='http')
			$str='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" height="211" width="'.$width.'"><param name="movie" value="'.$k['video_url'].'" /><param name="quality" value="high" /><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="true" /><embed src="'.$k['video_url'].'" allowScriptAccess="always" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowfullscreen="true" height="'.$height.'" width="'.$width.'" /></object>';
			else if($k['type']=='swf')
			$str='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" height="211" width="'.$width.'"><param name="movie" value="'.$k['video_url'].'" /><param name="quality" value="high" /><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="true" /><embed src="'.$config['weburl'].'/uploadfile/video/'.$k['video_url'].'" allowScriptAccess="always" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowfullscreen="true" height="'.$height.'" width="'.$width.'" /></object>';
			else
			$str='<embed height="'.$height.'" width="'.$width.'" type="application/x-shockwave-flash" allowfullscreen="true" wmode="transparent" quality="high" flashvars="file='.$config['weburl'].'/uploadfile/video/'.$k['video_url'].'" src="lib/flvplayer.swf" allowscriptaccess="never" allownetworking="internal">';
		}
	}
	$cache->str_end($str);
	return $str;
}
function insert_getproject($ar)
{
	global $db,$cache,$cachetime,$config,$buid;
	if(strlen($str=$cache->str_begin($ar,$cachetime))<=0)
	{
		$leng=$ar['leng'];
		$pointer=$ar['pointer'];
		if(empty($pointer))
			$pointer=0;
		$limit=$ar['limit'];
		if(empty($limit))
			$limit=5;
		$tj=$ar['rec'];
		if($tj)
             $sub_sql=" where state=1";
	    $sql="select id,userid,user,projecttitle from ".PROJECT." $sub_sql  order by uptime desc limit $pointer,$limit";
		$db->query($sql);
		$re=$db->getRows();
		$str='';
		foreach($re as $v)
		{
			$str.='<li><a href="'.geturl('project',$v['userid'],$v['user'],$v['id']).'" target="_blank">'.csubstr($v['projecttitle'],0,$leng)."</a></li>";
		}
	}
	$cache->str_end($str);
	return $str;
}
?>