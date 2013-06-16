<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");
include_once("config/reg_config.php");
$config = array_merge($config,$reg_config);
session_start();
//===================================
if(!empty($_POST["company"])&&!empty($_POST["contact"])&&!empty($_POST["mes"]))
{	
	if(strtolower($_SESSION["auth"])!=strtolower($_POST["yzm"]))
		header("Location:./aboutus.php?stype=2&msg=true");
	elseif($_SESSION['YZWT']!=$_POST['ckyzwt'] && $config['user_reg_verf']==1)
		header("Location:./aboutus.php?stype=3&msg=true");
	else
	{
		$_POST['mes'].='<br>'.date("Y-m-d H:i:s");
		$_POST['company'].='['.date("Y-m-d H:i:s").']';
		foreach($_POST as $key=>$v)
		{
			if($key!='mes')
				$_POST[$key]=htmlspecialchars($v);
		}
		if(empty($buid))
			$buid=0;
		$sql="insert into ".FEED." 
		(userid,company,contact,email,mes,iflook,province,city,tell,addr)
		values
		('$buid','$_POST[company]','$_POST[contact]','$_POST[email]','$_POST[mes]','0','$dpid','$dcid','$_POST[tell]','$_POST[addr]')";
		if($db->query($sql))
			header("Location:./aboutus.php?stype=1&msg=true");
		else
			header("Location:./aboutus.php?msg=true");
	}
	exit();
}
//====================================
if($buid)
{
	$sql="select company,contact from ".USER." where userid='$buid'";
	$db->query($sql);
	$de=$db->fetchRow();
	$tpl->assign("com",$de);
}
//-----------------------
$sql="select * from ".WEBCONGROUP;
$db->query($sql);
$con_groups = $db->getRows();
$tpl->assign("con_groups",$con_groups);

$sql="select * from ".WEBCON." where con_statu=1  order by con_no asc";
$db->query($sql);
$all_web = $db->getRows();
$tpl->assign("all_web",$all_web);
//-----------------------

$type=empty($_GET['type'])?1:$_GET['type'];
$sub_sql=NULL;
if(!empty($dpid))
	$sub_sql=" and con_province='$dpid' and (con_city='' or con_city is NULL) ";
if(!empty($dcid))
	$sub_sql=" and con_city='$dcid' ";
	
$sql="select con_desc,template,con_title,title,keywords,description,msg_online from ".WEBCON." WHERE con_id='$type' $sub_sql";
$db->query($sql);
$de=$db->fetchRow();
$tpl->assign("de",$de);
$config['title']=$de['title'];
$config['keyword']=$de['keywords'];
$config['description']=$de['description'];


$sql="select * from ".REGVERFCODE." order by rand() limit 0,1";
$db->query($sql);
$re=$db->fetchRow();
$tpl->assign("qut",$re['question']);
$_SESSION['YZWT']=$re['answer'];
//======================================
include_once("footer.php");
if(!empty($de['template'])&&file_exists($tpl->template_dir.'/'.$de['template']))
	$page=$de['template'];
else
	$page='aboutus.htm';
$tpl->display($page);
?>