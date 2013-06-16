<?php
@session_start();
if(empty($_SESSION["ADMIN_USER"])||empty($_SESSION["ADMIN_PASSWORD"]))
{
	echo '<SCRIPT   LANGUAGE="JavaScript">   
	top.location.href="index.php";   
	</SCRIPT>';
	die;
}	
if(empty($sctiptName))
{
	msg("noright.php");
	exit();
}	
if(!isset($_SESSION["ADMIN_USER"]))
	$_SESSION["ADMIN_USER"]=NULL;
//=================================
$p=NULL;
if(!empty($_POST)&&is_array($_POST))
{
	foreach($_POST as $v)
	{
		if(is_array($v))
			$p.=implode(",",$v);
		else
			$p.=','.$v;
	}
}
	
if($p!='')
	$p=csubstr($_SERVER['REQUEST_URI'].'&post='.$p,0,30);
else
	$p=csubstr($_SERVER['REQUEST_URI'],0,50);
$p=htmlspecialchars($p);
$sql="insert into ".OPLOG." (user,scriptname,url,time) values ('$_SESSION[ADMIN_USER]','$sctiptName','$p','".time()."')";
$db->query($sql);

//===============================
if(!empty($sctiptName))
{
	if($_SESSION["ADMIN_USER"]=="admin")
	{
		$sql="SELECT * FROM ".ADMIN."  WHERE user='".$_SESSION["ADMIN_USER"]."' AND password='".$_SESSION["ADMIN_PASSWORD"]."'";
	}
	else
	{
		$sql="
			SELECT
			  a.province,a.city,a.id,b.group_perms
			FROM
			  ".ADMIN." a, ".GROUP." b
			WHERE
			   a.group_id=b.group_id and a.user='".$_SESSION["ADMIN_USER"]."' AND a.password='".$_SESSION["ADMIN_PASSWORD"]."'";
	}
	$db->query($sql);unset($sql);
	$re=$db->fetchRow();
	if(!$re["id"])
	{	
		msg("index.php");//用户名或密码错误
	}
	else
	{
		if(isset($re["province"])&&!isset($_SESSION["city"]))
		{
			$_SESSION["province"]=$re["province"];
		}
		if(isset($re["city"])&&!isset($_SESSION["city"]))
		{
			$_SESSION["city"]=$re["city"];
		}
		if(!empty($re["group_perms"]))
		{
			$perm=explode(",",$re["group_perms"]);
			if(!in_array(md5($sctiptName),$perm)&&$sctiptName!='main.php')
			{
				msg("noright.php");
				exit();
			}
		}
	}
}
else
{
	if($_SESSION["ADMIN_USER"]!="admin"&&$sctiptName!="main.php")
	{
		msg("noright.php");
		exit();
	}
}
//===========================================================
$delimg='<img src="../image/admin/del.gif">';
$editimg='<img src="../image/admin/edit.gif">';
?>
