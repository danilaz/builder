<?php
session_start();
if(!empty($_POST['add_question'])&&!empty($_POST['qtitle'])&&empty($_POST['editid']))
{
	if(strtolower($_POST['myrands'])==strtolower($_SESSION["auth"]))
	{
		$t=time();
		if(!empty($_POST['catid']))
			$catid=$_POST['catid'];
		if(!empty($_POST['tcatid']))
			$catid=$_POST['tcatid'];
		if(!empty($_POST['scatid']))
			$catid=$_POST['scatid'];
		if(!empty($_POST['reward']))
			$rp=$_POST['reward'];
		else
			$rp='0';
		$sql="insert into  ".QUESTION." (title,catid,statu,userid,reward,answer_nums,uptime) values
		 ('$_POST[qtitle]','$catid','1','$buid','$rp','0','$t')";
		$db->query($sql);
		$id=$db->lastid();
		if(!empty($_POST['reward'])&&$_POST['reward']!='0')
		{
			$sql="update ".USER." set point=point-$_POST[reward] where userid='$buid'";
			$db->query($sql);
		}
		if(!empty($_POST['questiondes']))
			$qcon=str_replace(array("\r\n","\n","   "),array("<br>","<br>","&nbsp;"),$_POST['questiondes']);
		else
			$qcon='';
		$sql="insert into  ".QUESTDETAIL." (question_id,content) values ('$id','$qcon')";
		$db->query($sql);
		msg($config['weburl']."/?m=ask&s=question&id=".$id);
		die;
	}
	else
		msg($config['weburl'].'/?m=ask&s=add_question&errorcode=ok');
}
if(!empty($_POST['editid'])&&$_POST['myrands']==$_SESSION["auth"])
{
	if(!empty($_POST['catid']))
		$catid=$_POST['catid'];
	if(!empty($_POST['tcatid']))
		$catid=$_POST['tcatid'];
	if(!empty($_POST['scatid']))
		$catid=$_POST['scatid'];
	if(!empty($_POST['reward']))
		$rp=$_POST['reward'];
	else
		$rp='';
	if(!empty($_POST['questiondes']))
		$qcon=str_replace(array("\r\n","\n","   "),array("<br>","<br>","&nbsp;"),$_POST['questiondes']);
	else
		$qcon='';
	$sql="update ".QUESTION." set title='$_POST[qtitle]',catid='$catid',reward='$rp' 
	where id='$_POST[editid]' and userid='$buid'";
	$db->query($sql);
	$sql="select question_id from ".QUESTDETAIL." where question_id='$_POST[editid]'";
	$db->query($sql);
	$cp=$db->fetchRow();
	if($cp['question_id'])
	{
		$sql="update ".QUESTDETAIL." set content='$qcon' where question_id='$_POST[editid]'";
		$db->query($sql);
	}
	else
	{
		$sql="insert into  ".QUESTDETAIL." (question_id,content) values ('$_POST[editid]','$qcon')";
		$db->query($sql);
	}
	msg('main.php?action=admin_question');
}
if(!empty($_GET['catid']))
{
	if(strlen($_GET['catid'])>6)
		$tpl->assign("scat",$_GET['catid']);
	if(strlen($_GET['catid'])>4)
		$tpl->assign("tcat",substr($_GET['catid'],0,6));
	$tpl->assign("incat",substr($_GET['catid'],0,4));
}
$sql="select point from ".USER." where userid='$buid'";
$db->query($sql);
$ap=$db->fetchRow();
$tpl->assign("allp",$ap['point']);
$sql="select * from ".PCAT." where catid<9999 order by nums asc";
$db->query($sql);
$re=$db->getRows();
$tpl->assign("qcat",$re);
if(!empty($_GET['qid'])&&is_numeric($_GET['qid']))
{
	
	$sql="select a.*,b.content from ".QUESTION." a 
	left join ".QUESTDETAIL." b on a.id=b.question_id where a.id='$_GET[qid]' and a.statu!=2 and a.userid='$buid'";
	$db->query($sql);
	$eq=$db->fetchRow();
	$eq['content']=str_replace(array("<br>","<br>","&nbsp;"),array("\r\n","\n","   "),$eq['content']);
	$tpl->assign("editq",$eq);
	$sql="select point from ".USER." where userid='$buid'";
	$db->query($sql);
	$p=$db->fetchRow();
	$tpl->assign("allp",$p['point']);
}
//========分类============
$db->query("SELECT * FROM ".PCAT." WHERE catid<9999 ORDER BY nums");
$re=$db->getRows();
foreach($re as $key=>$v)
{
	 $re[$key]["sub"]=readsubcat($v["catid"]);
}
$tpl->assign("cat",$re);
unset($re);

//========统计============
$db->query("SELECT count(*) as zs FROM ".QUESTION." where statu=1");
$re=$db->fetchRow();
if(!empty($re['zs']))
	$tpl->assign("newq",$re['zs']);
else
	$tpl->assign("newq",'0');
$db->query("SELECT count(*) as zs FROM ".QUESTION." where statu=2");
$re=$db->fetchRow();
if(!empty($re['zs']))
	$tpl->assign("resq",$re['zs']);
else
	$tpl->assign("resq",'0');
$db->query("SELECT count(*) as zs FROM ".QUESTION." where reward>0");
$re=$db->fetchRow();
if(!empty($re['zs']))
	$tpl->assign("rewq",$re['zs']);
else
	$tpl->assign("rewq",'0');
	
$tpl->assign("current","ask");
include_once("footer.php");
$out=tplfetch("add_question.htm");
?>