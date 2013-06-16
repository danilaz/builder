<?php
if(!empty($_GET["id"])&&is_numeric($_GET["id"]))
	$id=$_GET["id"];
else
	header("Location: index.php");
$firstRow=!empty($_GET["firstRow"])?$_GET["firstRow"]:NULL;
$totalRows=!empty($_GET["totalRows"])?$_GET["totalRows"]:NULL;
//==============================================
session_start();
if(!empty($_POST['myanswer'])&&!empty($_POST['myrands']))
{
	if(strtolower($_POST['myrands'])==strtolower($_SESSION["auth"]))
	{
		$appc=str_replace(array("\r\n","\n","   "),array("<br>","<br>","&nbsp;"),$_POST['myanswer']);
		if(!empty($_POST['anuserid'])&&$_POST['anuserid']==$buid)
		{
			$sql="update ".QUESTDETAIL." set des=CONCAT(des,'$appc') where question_id='$id'";
			$db->query($sql);
			header("Location:?m=ask&s=question&id=".$id);
			die;
		}
		else
		{
			$nt=time();
			$sql="select uptime from ".ANSWER." where question_id='$id' and userid='$buid' order by uptime desc limit 1";
			$db->query($sql);
			$re=$db->fetchRow();
			if(empty($re['uptime']))
				$re['uptime']=0;
			if(($nt-$re['uptime'])>86400)
			{
				$sql="insert into  ".ANSWER." (question_id,userid,answer_con,best_answer,uptime) values('$id','$buid','$appc','0','$nt')";
				$db->query($sql);
				$sql="update ".QUESTION." set answer_nums=answer_nums+1 where id='$id'";
				$db->query($sql);
				include("config/point_config.php");
				if(!empty($point_config['point'])&&$point_config['point']=='1'&&!empty($point_config['answer'])&&$point_config['answer']!='0')
				renew_point('',$point_config['answer']);
				header("Location:?m=ask&s=question&id=".$id.'&answerok=1');
				die;
			}
			else
			{
				header("Location:?m=ask&s=question&id=".$id.'&sameday=1');
				die;
			}
		}
	}
	else
	{
		header("Location:?m=ask&s=question&id=".$id.'&errorcode=1');
		die;
	}

}
if(!empty($_GET['bestanswerid'])&&!empty($_GET['id']))
{
	$sql="select a.id,b.userid from ".QUESTION." a ,".ANSWER." b where a.id='$_GET[id]' and b.question_id=a.id and b.id='$_GET[bestanswerid]' and a.statu!=2 and a.userid='$buid' and b.best_answer!=1";
	$db->query($sql);
	$br=$db->fetchRow();
	if(!empty($br['id']))
	{
		$sql="update ".QUESTION." set statu=2 where id='$_GET[id]' and userid='$buid'";
		$db->query($sql);
		$sql="update ".ANSWER." set best_answer=1 where id='$_GET[bestanswerid]'";
		$db->query($sql);
		include("config/point_config.php");
		if($point_config['point']=='1'&&$point_config['bestanswer']!='0'&&!empty($point_config['bestanswer']))
		{
			$sql="update ".USER." set point=point+$point_config[bestanswer] where userid='$br[userid]'";
			$db->query($sql);
		}
		header("Location:?m=ask&s=question&id=".$_GET['id']);
	}
	else
		header("Location: index.php");
}
if(!empty($_GET['thanks'])&&!empty($_GET['id']))
{
	$sql="select id from ".QUESTION."  where id='$_GET[id]' and statu!=2 and userid='$buid'";
	$db->query($sql);
	$br=$db->fetchRow();
	if(!empty($br['id']))
	{
		$sql="update ".QUESTION." set statu=2 where id='$_GET[id]' and userid='$buid'";
		$db->query($sql);
		header("Location:?m=ask&s=question&id=".$_GET['id']);
	}
	else
		header("Location: index.php");
}
$sql="SELECT * FROM ".QUESTION." a left join ".QUESTDETAIL." b on a.id=b.question_id WHERE  a.id='$id'";
$db->query($sql);
$re=$db->fetchRow();
$tpl->assign("quest",$re);
if(strlen($re['catid'])>6)
	$tpl->assign("scat",$re['catid']);
if(strlen($re['catid'])>4)
	$tpl->assign("tcat",substr($re['catid'],0,6));
$tpl->assign("incat",substr($re['catid'],0,4));
//=====================
$config['title']=$re['title'].','.$config['title'];
$config['description']=$re['title'].','.$config['description'];
//相关问题
$sql="SELECT * FROM ".QUESTION." WHERE  catid='$re[catid]' and id!='$id' order by uptime desc limit 10";
$db->query($sql);
$rel=$db->getRows();
$tpl->assign("relquest",$rel);
unset($rel);
//导航
	$guide=NULL;
	$ks=NULL;
	$parcat=substr($re['catid'],0,4);
	$sql="select catid,cat from ".PCAT." where catid='$parcat'";
	$db->query($sql);
	$pcats=$db->fetchRow();
	if(!empty($pcats['cat']))
	{
	$guide.=" <a href='$config[weburl]/?m=ask&s=ask_list&id=$parcat'>".$pcats['cat']."</a> &raquo; ";
	$ks.=$pcats['cat'];
	}
	$parcat=substr($re['catid'],0,6);
	if(strlen($parcat)==6)
	{
		$sql="select catid,cat from ".PCAT." where catid='$parcat'";
		$db->query($sql);
		$pcatss=$db->fetchRow();
		if(!empty($pcatss['cat']))
		{
		$guide.=" <a href='$config[weburl]/?m=ask&s=ask_list&id=$parcat'>".$pcatss['cat']."</a> &raquo; ";
		$ks.=$pcatss['cat'];
		}
	}
	$parcat=substr($re['catid'],0,8);
	if(strlen($parcat)==8)
	{
		$sql="select catid,cat from ".PCAT." where catid='$parcat'";
		$db->query($sql);
		$pcatsss=$db->fetchRow();
		if(!empty($pcatsss['cat']))
		{
		$guide.=" <a href='$config[weburl]/?m=ask&s=ask_list&id=$parcat'>".$pcatsss['cat']."</a> &raquo; ";
		$ks.=$pcatsss['cat'];
		}
	}
$tpl->assign("guide",$guide.$re['title']);
$config['keyword']=$ks.','.$config['keyword'];
//提问者帐号
$tpl->assign("anuid",$re['userid']);
$sql="SELECT user FROM ".ALLUSER."  WHERE userid='$re[userid]'";
$db->query($sql);
$re=$db->fetchRow();
$tpl->assign("uname",$re['user']);
//有那些回复者
include_once("includes/page_utf_class.php");
$page = new Page;
$page->listRows=6;
$sql="SELECT a.*,b.user FROM ".ANSWER." a left join ".ALLUSER." b on  a.userid=b.userid  WHERE a.question_id='$id'  order by a.best_answer desc,uptime asc";
if (!$page->__get('totalRows'))
{
	$db->query("SELECT count(*) as num FROM ".ANSWER." a left join ".ALLUSER." b on  a.userid=b.userid WHERE  a.question_id='$id' ");
	$page->totalRows=$db->fetchField('num');
}
$sql .= "  limit ".$page->firstRow.", ".$page->listRows;
$db->query($sql);
$re=$db->getRows();
$allan['list']=$re;
$allan['pages']=$page->prompt();
$tpl->assign("answer",$allan);
$tpl->assign("allnums",$page->totalRows);
unset($re);
//===========================
$tpl->assign("current","ask");
include_once("footer.php");
$out=tplfetch("question.htm");
?>