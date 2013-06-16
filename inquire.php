<?php
/**
 * powered by b2bbuilder
 * Coprighty http://www.b2b-builder.com
 * Auter:brad zhang;
 * Des:abouts us
 */
include_once("includes/global.php");
include_once("includes/smarty_config.php");
//===================================
	session_start();
	if(!empty($_POST['submit']))
	{
		if(strtolower($_POST["yzm"])!=strtolower($_SESSION["auth"]))
			msg("inquire.php?contype=1&pid=$_GET[pid]&etype=1");
			
		include_once("includes/plugin_msg_class.php");
		$msg=new msg();
		$res=$msg->send_email();
		if($res)
			header("Location:inquire.php?1=1&type=1");
		else
			header("Location:inquire.php?1=1&type=2");
	}
	//---------------
	if(!empty($_GET['offerid'])&&empty($_GET['type']))
	{
		if(substr($_GET['offerid'],strlen($_GET['offerid'])-1,1)==',')
			$pid=$_GET['offerid'].'0';
		else
			$pid=$_GET['offerid'];
		$sql="select b.userid,b.user,b.company from ".INFO." a ,".USER." b where 
			a.userid=b.userid and a.id in ($pid) group by b.userid";
		$db->query($sql);
		$re=$db->getRows();
		$tpl->assign("receive",$re);
	}
	if(!empty($_GET['pid'])&&empty($_GET['type']))
	{
		if(substr($_GET['pid'],strlen($_GET['pid'])-1,1)==',')
			$pid=$_GET['pid'].'0';
		else
			$pid=$_GET['pid'];
		$sql="select b.userid,b.user,b.company from ".PRO." a ,".USER." b where 
			a.userid=b.userid and a.id in ($pid) group by b.userid";
		$db->query($sql);
		$re=$db->getRows();
		$tpl->assign("receive",$re);
	}
	if(!empty($_GET['userid'])&&empty($_GET['type']))
	{
		if(substr($_GET['userid'],strlen($_GET['userid'])-1,1)==',')
			$pid=$_GET['userid'].'0';
		else
			$pid=$_GET['userid'];
		$sql="select b.userid,b.user,b.company from ".USER." b where b.userid in ($pid)";
		$db->query($sql);
		$re=$db->getRows();
		$tpl->assign("receive",$re);
	}
	if(!empty($_POST['inquire'])&&empty($_GET['type']))
	{
		setcookie("com_inquery",NULL,time()*24*30,"/",$config['baseurl']);
		setcookie("pro_inquery",NULL,time()*24*30,"/",$config['baseurl']);
		setcookie("info_inquery",NULL,time()*24*30,"/",$config['baseurl']);
		
		$uid=implode(",",$_POST['userid']);
		$sql="select userid,user,company from ".USER." where userid in ($uid) ";
		$db->query($sql);
		$re=$db->getRows();
		$tpl->assign("receive",$re);
	}
	//---------------
	include_once("lang/$config[language]/company_type_config.php");
	$tpl->assign("receive_type",$receive_type);
	//---------------
	$tpl->assign("country",country_list());
	$tpl->assign("time",time()+3600*24*3);
//======================================
include_once("footer.php");
$tpl->display('inquire.htm');
?>