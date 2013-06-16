<?php
include_once("includes/news_function.php");
include_once("includes/global.php");
include_once("includes/smarty_config.php");
include_once("includes/point_inc.php");
//=========================================
$id=is_numeric($_GET["id"])?$_GET['id']:die('Error');
$pagecurrent=!empty($_GET['page'])&&is_numeric($_GET['page'])?$_GET['page']:1;
//=========================================
session_start();

if(!isset($_SESSION["IFPAY"]))
{
	if(!empty($buid))
	{
		$sql="select ifpay from ".USER." WHERE userid='$buid'";
		$db->query($sql);
		$_SESSION["IFPAY"]=$db->fetchField('ifpay');
		if(empty($_SESSION["IFPAY"]))
			$_SESSION["IFPAY"]=2;
	}
	else
		$_SESSION["IFPAY"]=1;
}

$db->query("update ".NEWSD." set onclick=onclick+1 where nid='$id'");
$db->query("select isgid,onclick from ".NEWSD." where nid='$id'");
$nd=$db->fetchRow();

function insert_readCount()
{
	global $nd;
	return $nd['onclick'];
}

if(!empty($nd['isgid'])&&$_SESSION['IFPAY']<$nd['isgid'])
{
	header("location:".$config['weburl']."/main.php?menu=service&action=admin_upgrade_group");
}
else
{
	user_read_rec($buid,$id,4);//Помните, когда член Посмотреть сообщение
	//==============================
	useCahe("news_detail/",true);
	$flag=md5($dpid.$dcid.$config["temp"].$id.$pagecurrent);
	if(!$tpl->is_cached("news_detail.htm",$flag))
	{
		
		$sql="SELECT a.*,b.con FROM ".NEWSD." a left join ".NEWSDATA." b on a.nid=b.nid WHERE a.nid='$id'";
		$db->query($sql);
		$news=$db->fetchRow();
		$news['cat']=get_cat($news['classid']);
		
		$newsc=str_replace('<div style="page-break-after: always">#[page]#</div>',"[#page#]",$news['con']);
		$newsc=str_replace('<div style="page-break-after: always;">#[page]#</div>',"[#page#]",$newsc);
		$articletext=array();
        $articletext=explode('[#page#]',$newsc);
        if($news['newstempid']==1)
		{
			$tpl->assign("newscon",$articletext);
			if(!empty($news['imgs_url']))
			{
				$array=	explode('|',$news['imgs_url']);
				foreach($array as $key=>$val)
				{	
					$news['imgs'][$key]=array('id'=>($key+1),'name'=>$val);
				}
			}
		}
		else
		{
			$nums=count($articletext);//Вычислить длину массива
			$cp=$pagecurrent-1;
			$phref='';
			if($nums>1)
			{
				 for($i=1;$i<=$nums;$i++)
				 {
						if($i!=$pagecurrent)
						  $phref=$phref.'<a href="'.$config['weburl'].'/?m=news&s=newsd&id='.$id.'&page='.$i.'"><span style="border:#b6daeb 1px solid;background-color:#ffffff;display:moz-inline-box;display:inline-block;height:25px;width:25px;"><font size=4>'.$i.'</font></span></a>&nbsp;&nbsp;';
						else
						  $phref=$phref.'<span style="border:#ffd6b4 1px solid;background-color:#b6daeb;display:block;display:-moz-inline-box; display:inline-block; height:25px;width:25px;"><font size=4>'.$i.'</font></span>&nbsp;&nbsp;';
				 }
			}
		}
	    $tpl->assign("pages",$phref);
        $tpl->assign("ncontent",$articletext[$cp]);
		
		
	    $config['keyword']=$news['title'].','.$news['keyboard'].','.$config['keyword'];
	    $config['title']=$news['title'];
		$config['description']=$news['smalltext'];
		
		
		if($news['vote']!=',')
		{
			$sql="select * from ".NEWSVOTE." where id in ($news[vote]0)";
			$db->query($sql);
			$vote=$db->getRows();
			foreach($vote as $key=>$val)
			{
				if(strtotime($val['time'])-time()<0 and strtotime($val['time']))
				{
					$vote[$key]['end']='1';	
				}
				if($_COOKIE['vote'.$buid.$val['id']])
				{
					$vote[$key]['ip']='1';	
				}
				$str=explode('|',$val['votetext']);
				for($i=0;$i<count($str);$i++)
				{
					$vote[$key]['item'][$i]=explode(',',$str[$i]);
				}
			}
		}
		$tpl->assign("vote",$vote);
		$tpl->assign("de",$news);
		$tpl->assign("current","news");
		include_once("footer.php");
		if($news['newstempid']==1)
		{
			$out=tplfetch("newspic.htm",$flag);
		}
		else
		{	
			$out=tplfetch("newsd.htm",$flag);
		}
		unset($news);
	}
	
}


?>

