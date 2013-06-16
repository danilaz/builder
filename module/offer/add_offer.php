<?php
include_once("includes/global.php");
include_once("$config[webroot]/lang/".$config['language']."/user_admin/global.php");
include_once("$config[webroot]/module/offer/lang/".$config['language']."/admin_offer.php");
@include_once("$config[webroot]/module/offer/lang/".$config['language']."/".$_GET['s'].".php");
include_once("$config[webroot]/module/offer/lang/".$config['language']."/upload.php");
include_once("$config[webroot]/includes/admin_class.php");

/*if(!$buid&&!empty($_POST['action'])&&$_POST['action']=='login'){
	if( !empty($_POST['user'])&&!empty($_POST['password']) ){
		//##==============Ajax Login===================
		$post = $_POST;
		include_once("config/reg_config.php");
		$config = array_merge($config,$reg_config);
		if($config['openbbs']==2)
		{	//ucenter1.5 login
			$sql="select userid,user,password,email from ".ALLUSER." a where user='$post[user]'";
			$db->query($sql);
			$re=$db->fetchRow();//bb用户是否存在
			if(!empty($re['password']))
			{
				if(substr($re['password'],0,4)=='lock')
					$status['login'] = -4;				//之前使用了找回密码功能，账户被锁定
				if($re['password']!=md5($post['password']))
					$status['login'] = -2;			//密码错误
			}	
			include_once('uc_client/client.php');
			list($uid, $username, $password, $email) = uc_user_login($post['user'], $post['password']);//uc是否存在
			
			if($uid>0||$re["userid"])
			{	//如果uc或者BB之中有一个账户是正确的执行如下操作
			
				if($uid<=0&&$re["userid"]>0)//UC不存在ＢＢ存在
				{
					$uid = uc_user_register($re['user'], $post['password'], $re['email']);
					if($re['pid'])
						login($re['pid'],$re['user'],$re['userid']);//子账号登录
					else
						login($re['userid'],$re['user']);//主账号登录
				}
				elseif($uid>0&&$re["userid"]<=0)//UC存在BB不存在
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
					login($re['userid'],$re['user']);//网站登录
				}
				
				uc_user_synlogin($uid);//ＵＣ同步登录
			}
			else
			{
				$status['login']=-3;//用户不存在
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
					$status['login']=-4;//之前使用了找回密码功能，账户被锁定
				if($re['password']!=md5($post['password']))
					$status['login']=-2;//密码错误
				
				if($re["password"]==md5($post['password']))
				{
					if($re['pid'])
						login($re['pid'],$re['user'],$re['userid']);//子账号登录
					else
						login($re['userid'],$re['user']);
						
					//$forward = $post['forward']?$post['forward']:$config["weburl"]."/main.php";
					//msg($forward);
					$status['login'] = true;
				}
			}
			else
				$status['login']=-3;//用户不存在
		}
		//==========================================
	}

}*/

if(!empty($_POST['submit'])){	
	
	include_once("$config[webroot]/module/offer/includes/offer_class.php");
	$offer=new offer();
	$status['login']=0;
	$status['offer']=0;
	//======================== register =========================
	if(!$buid&&!empty($_POST['user_action'])){
		if($_POST['user_action']==1){
			//--------------login---------------------
			if( !empty($_POST['login_user'])&&!empty($_POST['login_password']) ){
				$buid =0;
				$post = $_POST;
				$post['user'] = $_POST['login_user'];
				$post['password'] = $_POST['login_password'];
				include_once("config/reg_config.php");
				$config = array_merge($config,$reg_config);
				if($config['openbbs']==2)
				{	
					//ucenter1.5 login
					$sql="select userid,user,password,email from ".ALLUSER." a where user='$post[user]'";
					$db->query($sql);
					$re=$db->fetchRow();//bb用户是否存在
					if(!empty($re['password']))
					{
						if(substr($re['password'],0,4)=='lock')
							$status['login'] = -4;				//之前使用了找回密码功能，账户被锁定
						if($re['password']!=md5($post['password']))
							$status['login'] = -2;			//密码错误
					}	
					include_once('uc_client/client.php');
					list($uid, $username, $password, $email) = uc_user_login($post['user'], $post['password']);//uc是否存在
					
					if($uid>0||$re["userid"])
					{	//如果uc或者BB之中有一个账户是正确的执行如下操作
					
						if($uid<=0&&$re["userid"]>0)//UC不存在ＢＢ存在
						{
							$uid = uc_user_register($re['user'], $post['password'], $re['email']);
							if($re['pid'])
								login($re['pid'],$re['user'],$re['userid']);//子账号登录
							else
								login($re['userid'],$re['user']);//主账号登录
						}
						elseif($uid>0&&$re["userid"]<=0)//UC存在BB不存在
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
							login($re['userid'],$re['user']);//网站登录
						}
						$buid = $uid;
						uc_user_synlogin($uid);//ＵＣ同步登录
					}
					else
					{
						$status['login']=-3;//用户不存在
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
							$status['login']=-4;//之前使用了找回密码功能，账户被锁定
						if($re['password']!=md5($post['password']))
							$status['login']=-2;//密码错误
						
						if($re["password"]==md5($post['password']))
						{
							if($re['pid']){
								login($re['pid'],$re['user'],$re['userid']);//子账号登录
								$buid = $re['pid'];
							}
							else{
								login($re['userid'],$re['user']);
								$buid = $re['userid'];
							}
							
							$status['login'] = true;
						}
					}
					else
						$status['login']=-3;//用户不存在
				}
			}
			//----------------------------------------
		}elseif($_POST['user_action']==2){
			$buid = doreg();
			if($buid==0){
				$status['login'] = -5;
			}
		}
	}
	
	//============================================================
	if($buid>0){
		//====================add_offer==================添加一个报价请求
		include_once("$config[webroot]/module/product/includes/plugin_pro_class.php");
		$pro=new pro();
		//##===============
		$pactidlist=!empty($_POST['catid'])?$_POST['catid']:NULL;
		if(!empty($_POST['tcatid']))
			$pactidlist.= ",".$_POST['tcatid'];
		if(!empty($_POST['scatid']))
			$pactidlist.=",".$_POST['scatid'];
		if(!empty($_POST['sscatid']))
			$pactidlist.=",".$_POST['sscatid'];
		$pro->add_user_common_cat($pactidlist); //增加会员常用类别
		//###===============

		$offer_id = $offer->add_info();

		if($offer_id){
			//添加附件
			if(!empty($_POST['attach_file']))
				$offer->add_attach($offer_id);
			
			$status['offer']=true;
			//msg("main.php?action=m&m=offer&s=admin_offer_list&menu=info&menu=info");
		}
	}
	//=================================================================
	echo "<script>parent.window.reqComplete(".$status['login'].",".$status['offer'].");</script>";
	die();
}else{

	//#########========================================
	include_once("$config[webroot]/lang/".$config['language']."/company_type_config.php");
	$tpl->assign("infoType",$infoType);
	$tpl->assign("ptype",$ptype);
	$tpl->assign("trade_type",$trade_type);
	$tpl->assign("unit",$unit);
	$tpl->assign("validTime",$validTime);
	$tpl->assign("prov",get_province());

	if($buid){
		$admin = new admin();
		$tpl->assign("custom_cat",$admin->get_custom_cat_list(1,0));
	}else{
		include_once("config/reg_config.php");
		include_once("$config[webroot]/lang/".$config['language']."/front/login.php");
		$config = array_merge($config,$reg_config);
		//====================================================
		stop_ip($stop_reg);
		unset($stop_reg);
		//------------------------------------------------------------------------
		include_once('lang/'.$config['language'].'/front/reg.php');
		include_once('lang/'.$config['language'].'/company_type_config.php');
		$lang['title'] = $lang['product_releases'];
		$tpl->assign("country",country_list());
		$tpl->assign("ctype",$companyType);

	}

	include_once("footer.php");
	$tpl->assign("current","offer");
	$tpl->assign( "upload",$upload  );
	$tpl->assign("config",$config);
	$tpl->assign("lang",$lang);
	//===========================================
	$tpl->assign("current","offer");
	$tpl->assign('guide',$lang['product_releases']);
	$out = tplfetch("add_offer.htm");
}






//###------------------------------------------
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
			return $userid;
			//============================================================
		}
	 }
	 else
		 return 0;
}

//##login
function login($uid,$username,$pid=NULL)
{
	global $post,$config;
	$db=new dba($config['dbhost'],$config['dbuser'],$config['dbpass'],$config['dbname']);
	
	$sql="select a.lastLoginTime,b.regtime,b.ifpay from ".ALLUSER." a left join ".USER." b on a.userid=b.userid where a.user='$post[user]'";
	$db->query($sql);
	$re=$db->fetchRow();

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
?>