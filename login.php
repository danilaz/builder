<?php
session_start();
if(!empty($_GET["action"]))
	$post=$_GET;
else
	$post=$_POST; 
if(!empty($post["action"])&&$post["action"]=="submit")
{
	if(strtolower($_SESSION["auth"])!=strtolower($post["randcode"]))
	{
		header("Location: login.php?erry=-3");//��֤�����
		exit();
	} 
	include_once("includes/global.php");
	include_once("includes/smarty_config.php");
	include_once("config/reg_config.php");
	$config = array_merge($config,$reg_config);
	if($config['openbbs']==2)
	{	//ucenter1.5 login
		$sql="select userid,user,password,email from ".ALLUSER." a where user='$post[user]'";
		$db->query($sql);
		$re=$db->fetchRow();//bb�û��Ƿ����
		if(!empty($re['password']))
		{
			if(substr($re['password'],0,4)=='lock')
				msg('login.php?erry=-4');//֮ǰʹ�����һ����빦�ܣ��˻�������
			if($re['password']!=md5($post['password']))
				msg('login.php?erry=-2');//�������
		}
		include_once('uc_client/client.php');
		list($uid, $username, $password, $email) = uc_user_login($post['user'], $post['password']);//uc�Ƿ����
		
		if($uid>0||$re["userid"])
		{	//���uc����BB֮����һ���˻�����ȷ��ִ�����²���
		
			if($uid<=0&&$re["userid"]>0)//UC�����ڣ£´���
			{
				$uid = uc_user_register($re['user'], $post['password'], $re['email']);
				if($re['pid'])
					login($re['pid'],$re['user'],$re['userid']);//���˺ŵ�¼
				else
					login($re['userid'],$re['user']);//���˺ŵ�¼
			}
			elseif($uid>0&&$re["userid"]<=0)//UC����BB������
			{
				$dbc=new dba($config['dbhost'],$config['dbuser'],$config['dbpass'],$config['dbname']);
				
				$ip=getip();
				$dbc->query("insert into ".ALLUSER." (user,email,password,ip) values 
				('$post[user]','$email','".md5($post['password'])."','$ip')");
				$re['userid']=$dbc->lastid();
				$re['user']=$_POST['user'];
				
				if(empty($config['user_reg']))
					$user_reg=1;
				elseif($config['user_reg']==3)
					$user_reg=1;
				else
					$user_reg=$config['user_reg'];
					
				$sql="INSERT INTO ".USER." 
				(userid,regtime,template,country,ifpay) VALUES 
				('$re[userid]','".date("Y-m-d H:i:s")."','".$config['default_user_tem']."','$country','$user_reg')";
				$db->query($sql);
				login($re['userid'],$re['user']);//��վ��¼
			}
			else
			{
				if($re['pid'])
					login($re['pid'],$re['user'],$re['userid']);//���˺ŵ�¼
				else
					login($re['userid'],$re['user']);//���˺ŵ�¼
			}
			echo uc_user_synlogin($uid);//�գ�ͬ����¼
			$forward = $post['forward']?$post['forward']:$config["weburl"]."/main.php";
			msg($forward);
		}
		else
		{
			header("Location: login.php?erry=-1");//�û�������
			exit();
		}
	}
	else
	{	
		// no ucenter login
		$sql="select * from ".ALLUSER." where user='$post[user]'";
		$db->query($sql);
		$re=$db->fetchRow();
		if($re["userid"])
		{
			if(substr($re['password'],0,4)=='lock')
				msg('login.php?erry=-4');//֮ǰʹ�����һ����빦�ܣ��˻�������
			if($re['password']!=md5($post['password']))
				msg('login.php?erry=-2');//�������
			
			if($re["password"]==md5($post['password']))
			{
				if($re['pid'])
					login($re['pid'],$re['user'],$re['userid']);//���˺ŵ�¼
				else
					login($re['userid'],$re['user']);
					
				$forward = $post['forward']?$post['forward']:$config["weburl"]."/main.php";
				msg($forward);
			}
		}
		else
			msg('login.php?erry=-1');//�û�������
	}
}
//========================================================
function login($uid,$username,$pid=NULL)
{

	global $post,$config;
	$db=new dba($config['dbhost'],$config['dbuser'],$config['dbpass'],$config['dbname']);
	
	$sql="select a.lastLoginTime,b.regtime,b.ifpay from ".ALLUSER." a left join ".USER." b on a.userid=b.userid where a.user='$post[user]'";
	$db->query($sql);
	$re=$db->fetchRow();
	if(is_dir("$config[webroot]/t/"))
	{
		//=====΢���󶨵�¼=====
		if($re)
		{
			include_once 't/application/adapter/account/xauthCookie_account.adp.php';
			$xwbAccount = new xauthCookie_account();
			$xwbAccount->_setLocalToken(null);
			$xwbAccount->_setLocalToken( array('uid'=>$uid,'uname'=>$username));
		}
		//=====================
	}

	bsetcookie("USERID","$uid\t$username\t$pid",NULL,"/",$config['baseurl']);
	setcookie("USER",$username,NULL,"/",$config['baseurl']);
	$_SESSION["IFPAY"]=$re['ifpay'];
	
	if(time()-$re["lastLoginTime"]>=3600)
	{
		include("config/point_config.php");
		if($point_config['point']=='1'&&$point_config['every_logo']!='0')
			renew_point('',$point_config['every_logo']);
	}
	
	if(!empty($re["lastLoginTime"])&&empty($re['regtime']))
	{
		$sql="update ".USER." set regtime='".date("Y-m-d H:i:s")."' WHERE userid='$uid'";
		$db->query($sql);
	}
	else
	{
		$sql="update ".ALLUSER." set lastLoginTime='".time()."' WHERE userid='$uid'";
		$db->query($sql);
	}
}
//==================================================================================
include_once("includes/global.php");
include_once("includes/smarty_config.php");
include_once("config/reg_config.php");
$config = array_merge($config,$reg_config);
if(!empty($_GET["user"])&&!empty($_GET["email"]))
{
	$sql="select user,userid from ".ALLUSER." where user='$_GET[user]' and email='$_GET[email]'";
	$db->query($sql);
	$re=$db->fetchRow();
	if(!empty($re['user']))
	{
		$sql="update ".USER." set ifpay=2 where userid=$re[userid]";
		$db->query($sql);
		header("Location:login.php?user_name=$re[user]");
		exit();
	}
}
if($buid&&empty($_GET['style']))
{
	header("Location:main.php");
	exit();
}


include_once("footer.php");
$tpl -> assign("current","office");
if(!empty($_GET['style']))
	$tpl->display("login_box.htm");
else
	$tpl->display("login.htm");
?>