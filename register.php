<?php
/**
 * 注册页面
 * Powered by B2Bbuilder
 */
include_once("includes/global.php");
include_once("includes/smarty_config.php");
include_once("config/reg_config.php");
$config = array_merge($config,$reg_config);
//====================================================
stop_ip($stop_reg);
unset($stop_reg);
//----------------------------------------------------
session_start();
if(!empty($_POST['user'])&&strtolower($_POST['yzm'])==strtolower($_SESSION['auth']))
{
	if($config['closetype']==2)
	{
		die('access dined!');
	}
	if($config['user_reg_verf'])
	{
		if(trim($_POST['ckyzwt'])!=trim($_SESSION['YZWT']))
			 die("Ошибка проверочного вопроса...");
	}
	if($config['inhibit_ip']==1)
	{
		$ip=getip();
		if(empty($ip))
			die("Нельзя зайти с Вашего IP...");
		else
		{	
			$config['exception_ip']=explode("\r\n",$config['exception_ip']);
			if(!in_array($ip,$config['exception_ip']))
			{
				$sql="select ip from ".ALLUSER." where ip='$ip'";
				$db->query($sql);
				if($db->num_rows())
					die("Ваш IP был записан...");
				unset($sql);
			}
		}
	}
	if($config['openbbs']==2)
	{	
		include_once('uc_client/client.php');
		$user=trim($_POST['user']);
		$pass=trim($_POST['password']);
		$email=trim($_POST['email']);
		$regtime=time();
		$uid = uc_user_register($user, $pass, $email);
		if($uid>0)
		{
			doreg($uid);
			/*免激活
			$sql="insert into cdb_members
		    (uid,username,password,groupid,regip,regdate,email,timeoffset,lastvisit,lastactivity)
		     values
		     ('$uid','$user','$pass','10','hidden','$regtime','$email','9999','$regtime','$regtime')";
		    $db->query($sql);
			*/
		}
	}
	else
		doreg();
}

function doreg($guid=NULL)
{
	global $config,$ip;
	$_POST['sex']=empty($_POST['sex'])?0:$_POST['sex'];
	$ip=getip();
	$ip=empty($ip)?NULL:$ip;
		
	$db=new dba($config['dbhost'],$config['dbuser'],$config['dbpass'],$config['dbname']);
	$user=$_POST['user'];
	$pass=$_POST['password'];
	$email=$_POST['email'];
	$country=$_POST['country'];	
	$sql="select * from  ".ALLUSER." where user='$user'";
    $db->query($sql);
    if($db->num_rows())
		die("This is register Robot");
	$nt=time();
	$sql="insert into ".ALLUSER."
	 (user,password,ip,lastLoginTime,qq,msn,sex,mobile,position,email)
	 values
	 ('$user','".md5($pass)."','$ip','$nt','$_POST[qq]','$_POST[msn]','$_POST[sex]','$_POST[mobile]','$_POST[pos]','$email')";
	$db->query($sql);
	if($userid=$db->lastid())
	{	
		if(!empty($config['user_reg'])&&$config['user_reg']!=3)
			$user_reg=$config['user_reg'];
		elseif($config['user_reg']==3)
			$user_reg=1;
		else
			$user_reg=2;
		$regtime=date("Y-m-d H:i:s");$catid=NULL;
		if(isset($config['detail_reg'])&&$config['detail_reg']==1)
		{
			if(!empty($_POST['catid']))
				$catid=$_POST['catid'];
			if(!empty($_POST['tcatid']))
				$catid=$catid.",".$_POST['tcatid'];
			if(!empty($_POST['scatid']))
				$catid=$catid.",".$_POST['scatid'];
			$catid=$catid.',';
			$sql="INSERT INTO ".USER." 
			(userid,user,regtime,template,country,ifpay,company,contact,tel,fax,addr,catid,ctype,identity) 
			VALUES 
			('$userid','$user','$regtime','$config[default_user_tem]','$country','$user_reg','$_POST[comname]',
			'$_POST[realname]','$_POST[tel]','$_POST[fax]','$_POST[addr]','$catid','$_POST[ctype]','$_POST[identity]')";
			$re=$db->query($sql);
		}
		else
		{
			$sql="INSERT INTO ".USER." 
			(userid,user,regtime,template,country,ifpay) 
				VALUES 
			('$userid','$user','$regtime','$config[default_user_tem]','$country','$user_reg')";
			$re=$db->query($sql);
		}
		if($re)
		{
			include("config/point_config.php");
			if($point_config['point']=='1'&&$point_config['add_product']!='0')
			renew_point('reg',$point_config['reg_user'],$userid);

			bsetcookie("USERID","$userid\t$user",NULL,"/",$config['baseurl']);
			setcookie("USER",$user,NULL,"/",$config['baseurl']);
			//============================================================
			if($config['openregemail'])
			{
			     //2无需认证1人工审核3邮件认证
				 if($config['user_reg']==3)
				 {
					 $activeurl="$config[weburl]/login.php?user=$user&email=$email";
					 $mail_temp=get_mail_template('active');
				 }
				 else
				 	$mail_temp=get_mail_template('register');
				 $con=$mail_temp['message'];
				 $ar1=array('[username]','[email]','[weburl]','[activeurl]');
				 $ar2=array($user,$email,$config['weburl'],$activeurl);
				 $con=str_replace($ar1,$ar2,$con);
				 send_mail($email,$user,$config['company'],$con);
				 unset($con);
			}
			//============================================================
			if($config['user_reg']==3)
			{
				header("Location: $config[regname]?regsuc=1");//提醒查收邮件
			    exit();
			}
			else
			{
				header("Location: main.php?action=admin_personal&info=3&guid=$guid");
				exit();
			}
		}
	 }
	 else
		 die("Can not register...");
}
//=====================================================
$_GET['regsuc']=empty($_GET['regsuc'])?NULL:$_GET['regsuc'];
if($buid&&$config['user_reg']!=3)
	msg('main.php');

include_once('lang/'.$config['language'].'/front/reg.php');
include_once('lang/'.$config['language'].'/company_type_config.php');
$tpl->assign("country",country_list());
$tpl->assign("ctype",$companyType);
include_once("footer.php");

if(isset($config['detail_reg'])&&$config['detail_reg']==1)
{
	$db->query("SELECT * FROM ".COMPANYCAT." WHERE catid<9999 ORDER BY nums ASC");
	$c=$db->getRows();
	$tpl->assign("cat",$c);
	$tpl->display("detail_register.htm");
}
else
	$tpl->display("register.htm");
?>