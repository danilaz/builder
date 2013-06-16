<?php
/*
if(!empty($_POST))
{
	if(!isset($_COOKIE['lasttime']))
		setcookie('lasttime',time());
	else
	{
		if(time()-$_COOKIE['lasttime']<10)
			die('您发布的太快了');
		setcookie('lasttime',time());
	}

}
*/
session_start();
include_once("includes/global.php");
include_once("includes/smarty_config.php");
include_once("includes/admin_class.php");
//===============================================
$action=isset($_GET['action'])?$_GET['action']:"main";
$submit=isset($_POST['submit'])?$_POST['submit']:NULL;
$deid=isset($_GET['deid'])?$_GET['deid']:NULL;

$admin = new admin();
$admin->is_login($action);
if(!empty($_POST)||!empty($_GET['deid'])||!empty($_GET['rec']))
	$admin->clear_user_shop_cache();
switch ($action){
	case "admin_shop_set":
	{	
		$admin->check_myshop();
		include_once("includes/plugin_temp_class.php");
		$temp=new temp();			
		if(!empty($_POST['sconfig']))
		{				
			$admin->check_access('shop_setting');
			$temp->update_shop_setting();
		}
		if(file_exists($config['webroot']."/config/shop_config/shop_config_".$buid.'.php'))
		{
			include_once($config['webroot']."/config/shop_config/shop_config_".$buid.'.php');
			$tpl->assign('have_set',1);			
		}
		else
		{
			//$shopconfig=$temp->get_shop_setting();
			//if(!$shopconfig)
			//{
				include_once("lang/".$config['language']."/admin_menu.inc.php");
				include_once("lang/".$config['language']."/user_admin/shop_default_config.php");
			//}
		}
		$tpl->assign("shopconfig",$shopconfig);
		$page="admin_shop_setting.htm";
		break;
	}
	case "admin_subscribe":
	{	
		include_once("includes/plugin_tradealter_class.php");
		$tradealter=new tradealter();
		
		$admin->check_myshop();
		$tpl->assign("el",$tradealter->email_list($buid));
		if(!empty($_POST['addid']))
		{
			
			if(!empty($_POST['seditid']))
				$re=$tradealter->up_subscribe($_POST['seditid']);
			else
			{
				$admin->check_access('subscribe');
				$re=$tradealter->up_subscribe();
			}
			if($re)
				msg("main.php?menu=$_GET[menu]&action=admin_subscribe");
		}
		if(!empty($_GET['editid']))
			$tpl->assign("de",$tradealter->list_subscribe($_GET['editid']));
		if(!empty($_GET['delid']))
			$tradealter->delete_subscribe($_GET['delid']);
		$tpl->assign("subscribe",$tradealter->list_subscribe());
		$page="admin_subscribe.htm";
		break;
	}
	case "admin_buy_point":
	{	
		include_once("includes/plugin_payment_class.php");
		$payment=new payment();
		if(isset($_POST['Submit'])&&isset($_POST['points'])&&is_numeric($_POST['points']))
				$payment->buy_point();
		$cash=$payment->payment_base();
		$tpl->assign("re",$cash);
		$tpl->assign("myrank",$payment->point_ranks());
		@include_once("config/point_config.php");
		$tpl->assign("rates",$point_config['rmb_point']);
		$canbuypoint=number_format($cash['cash']*$point_config['rmb_point'],0,'','');
		$tpl->assign("buypoints",$canbuypoint);
		$page= "admin_buy_point.htm";
		break;
	}
	case "admin_upgrade_group":
	{	
		include_once("includes/plugin_payment_class.php");
		$payment=new payment();
		if(isset($_POST['Submit'])&&isset($_POST['years'])&&is_numeric($_POST['years']))
				$payment->upgrade_group();
		
		include_once("config/usergroup.php");
		$tpl->assign("gr",$group);
		$gp=$payment->get_group();
		$tpl->assign("re",$payment->payment_base());
		$tpl->assign("gp",$group[$gp['ifpay']]['name']);
		$tpl->assign("nogp",$gp['ifpay']);
		$page= "admin_upgrade_group.htm";
		break;
	}
	case "admin_accounts_base":
	{	
		include_once("includes/plugin_payment_class.php");
		$payment=new payment();
		$payment->apply_result();
		$tpl->assign("re",$payment->payment_base());
		$page= "admin_accounts_base.htm";
		break;
	}
	case "admin_accounts_bind":
	{	
		include_once("includes/plugin_payment_class.php");
		$payment=new payment();
		$tpl->assign("re",$payment->payment_bind());
		$page= "admin_accounts_bind.htm";
		break;
	}
	case "admin_accounts_pay":
	{	
		include_once("includes/plugin_payment_class.php");
		$payment=new payment();
		if(!empty($_POST['amount']))
			$payment->online_pay();
		
		$tpl->assign("re",$payment->payment_pay());
		$page= "admin_accounts_pay.htm";
		break;
	}
	case "admin_accounts_pickup":
	{	
		include_once("includes/plugin_payment_class.php");
		$payment=new payment();
		$tpl->assign("re",$payment->payment_pickup());
		$page= "admin_accounts_pickup.htm";
		break;
	}
	case "admin_accounts_cashflow":
	{	
		include_once("includes/plugin_payment_class.php");
		$payment=new payment();
		include_once("lang/".$config['language']."/user_admin/cashflow_config.php");
		$re= $payment->payment_cashflow();
		$earning = 0;
		$pay = 0;
		for($i=0;$i<count($re['list']);$i++)
		{
			if($re['list'][$i]['is_succeed']==1)
			{
				if($re['list'][$i]['amount']<0)
					$pay += $re['list'][$i]['amount'];
				else
					$earning += $re['list'][$i]['amount'];
			}
			$re['list'][$i]['cashflow_type']=$cash['cashtype'][$re['list'][$i]['cashflow_type']];
			if(isset($cash['note'][$re['list'][$i]['user_note']]))
				$re['list'][$i]['user_note']=$cash['note'][$re['list'][$i]['user_note']];
			$re['list'][$i]['is_succeed']=$cash['statu'][$re['list'][$i]['is_succeed']];
		}
		$tpl->assign("re",$re);
		$tpl->assign("earning",$earning);
		$tpl->assign("pay",-$pay);
		$tpl->assign("allt",$pay+$earning);
		$tpl->assign("cashconfig",$cash['cashtype']);
		unset($cash);
		$page= "admin_accounts_cashflow.htm";
		break;
	}
    case "myfavorite":
	{
		include_once("includes/plugin_fav_class.php");
		$fav=new fav();
		include_once("includes/page_utf_class.php");
		if(!empty($_GET['delid']))
		{
			$fav->favorite($_GET['delid']);
		}
		$tpl->assign("myfav",$fav->favorite());
		$page     ="admin_favorite.htm";
		break;
	}
	case "admin_link":
	{
		include_once("includes/plugin_links_class.php");
		$links=new links();
		if(!empty($_POST['link_name']))
		{
			$admin->check_access('link');
			if($links->add_link())
				header("Location:main.php?menu=$_GET[menu]&action=admin_link_list");
		}
		$page     ="admin_link.htm";
		break;
	}
	case "admin_link_list":
	{
		include_once("includes/plugin_links_class.php");
		$links=new links();
		if(isset($_GET['deid']))
			$links->del_link($_GET['deid']);
		$tpl->assign("link",$links->link_list());
		$page     ="admin_link_list.htm";
		break;
	}
	case "mail_det":
	{	
		include_once("includes/plugin_msg_class.php");
		$msg=new msg();
		$msg->repliy_mail();
		$tpl->assign("re",$msg ->mail_det($_GET['id']));
		$page     ="admin_mail_det.htm";
		break;
	}
	case "admin_mail_list":
	{	
		include_once("includes/page_utf_class.php");
		include_once("includes/plugin_msg_class.php");
		$msg=new msg();
		$msg     ->del_mail();
		$msg	 ->save_mail();
		$msg	 ->remove_mail();
		$msg	 ->recover_mail();
		$type=isset($_GET['type'])?$_GET['type']:'inbox';
		$tpl->assign("re",$msg ->mail_list($type));
		$page     ="admin_mail_list.htm";
		break;
	}
	case "admin_personal":
	{	
		if(!empty($b2bbuilder_auth['2']))
			$buid=$b2bbuilder_auth['2'];//子账号ＩＤ替换父账号ＩＤ
		if(!empty($_GET['deid']))
			$admin->delete_personal($_GET['deid']);
			
		if(!empty($_POST['action'])&&$_POST['action']=='submit')
		{
			$admin->add_personal();
			msg("main.php?action=admin_personal&menu=$_GET[menu]&t=1&adduser=$_GET[adduser]");
		}
		if(!empty($_POST['action'])&&$_POST['action']=='update')
		{	
			$admin->update_personal($_POST['uid']);
			if(empty($_GET['adduser']))
				msg("main.php?action=myshop&menu=$_GET[menu]");
			else
				msg("main.php?action=admin_personal&menu=$_GET[menu]&adduser=$_GET[adduser]&t=1");
		}
		header("Pragma: no-cache");
		include_once("lang/".$config['language']."/company_type_config.php");
		$tpl->assign("de",$de=$admin->get_personal_detail($_GET['editid']));
		$tpl->assign("plist",$admin->get_personal_list($buid));
		$tpl->assign("prov",get_province($de['province']));
		if(!empty($_GET['guid']))
		{
			include_once('uc_client/client.php');
			$tpl->assign("slogin",uc_user_synlogin($_GET['guid']));
		}
		if(!empty($_GET['adduser']))
		{
			$nohead='true';
			$page="admin_add_personal.htm";
			if(empty($_GET['editid']))
				$tpl->assign("de",NULL);
		}
		else
			$page="admin_personal.htm";
		break;
	}
	case "cominfo":
	{	
		include_once("includes/plugin_user_class.php");
		$user=new user();
		if(!empty($_POST['Submit'])||!empty($_POST['Submit-next']))
		{	
			$re=$user->update_user_info();
			if($_GET['type']<4)
			{
				if(!empty($_POST['Submit-next']))
					msg("main.php?action=cominfo&type=".($_GET['type']+1)."&menu=$_GET[menu]");
				else
					msg("main.php?action=cominfo&type=".$_GET['type']."&menu=$_GET[menu]");
			}
			else
				msg("main.php?menu=$_GET[menu]&action=msg&type=reg_next");
		}
		$tpl->assign("de",$de=$user->get_user_info($buid,$_GET['type']));
		$page="admin_cominfo.htm";
		break;
	}
	
	case "myshop":
	{	
		header("Pragma: no-cache");
		include_once("includes/plugin_user_class.php");
		$user=new user();
		if(!empty($_POST['Submit']))
		{	
			$re=$user->update_user();
			$admin->check_myshop();
			if($_SESSION["IFPAY"]<2)
				msg("main.php?menu=$_GET[menu]&action=active");
			else
				msg("main.php?action=cominfo&type=1&menu=user");
		}
		include_once("lang/".$config['language']."/company_type_config.php");
		$tpl->assign("companyType",$companyType);
		$tpl->assign("de",$de=$user->get_user_detail($buid));
		$tpl->assign("com_cat",$admin->getComCat());
		$tpl->assign("prov",get_province($de['province']));
		$page="admin_myshop.htm";
		break;
	}
	case "business_info":
	{	
		include_once("includes/plugin_bizinfo_class.php");
		$bizinfo=new bizinfo();
		$de=$bizinfo->update_business_info();

		$tpl->assign("de",$de);
		if(isset($de['statu']) && $de['statu']>0){
			$page="admin_business_info_approved.htm";
		}else{
			$page="admin_business_info.htm";
		}
		break;
	}
	case "setpassword":
	{
		if(isset($_POST["action"]))
		{
			if(!empty($b2bbuilder_auth['2']))
				$buid=$b2bbuilder_auth['2'];//子账号ＩＤ替换父账号ＩＤ
			$admin->resetpass($buid);
		}
		$page="admin_resetpass.htm";
		$current="myshop";
		break;
	}
	case "template":
	{
		include_once("includes/plugin_temp_class.php");
		$temp=new temp();
		if(isset($_GET['select_tem']))
			$temp->update_user_tem($_GET['select_tem']);
		else
		{	
			include_once("includes/plugin_user_class.php");
			$user=new user();
			$re=$user->get_user_detail($buid);
			$tpl->assign("de",$re);

			include($config['webroot']."/config/usergroup.php");
			$usergroup=array();
			foreach($group as $v)
			{
				if($v['group_id']>1)
				{	
					$g['group_id']=$v['group_id'];
					$g['name']=$v['name'];
					$usergroup[]=$g;
				}
			}
			$tpl->assign("group",$usergroup);
			$tpl->assign("cat",get_comcat());
			//--------------------------
			$tpl->assign("templist",$temp->user_temp_list());
		}
		$page="admin_template.htm";
		break;
	}
	case "logout":
	{
		global $config;
		include_once("$config[webroot]/config/reg_config.php");
		$config = array_merge($config,$reg_config);
		bsetcookie("USERID",NULL,time(),"/",$config['baseurl']);
		setcookie("USER",NULL,time(),"/",$config['baseurl']);
		//====微博同步登出====
		if(is_dir("$config[webroot]/t/")){
			include_once "$config[webroot]/t/application/adapter/account/xauthCookie_account.adp.php";
			$xwbAccount = new xauthCookie_account();
			$xwbAccount->_setLocalToken(NULL);
			unset( $_SESSION['XWB_OAUTH_CONFIRM'] );
			session_destroy();
		}
		//=====================
		if($config['openbbs']==2)
		{
			include_once("$config[webroot]/uc_client/client.php");
			echo uc_user_synlogout();
		}
		//unset($_SESSION['IFPAY']);
		msg("$config[weburl]/index.php");
		break;
	}
	case "add_domin":
	{
		if(!empty($_POST['domain']))
			$admin->add_domin($buid);
		$tpl->assign("domin",$admin->get_myshop_domin($buid));
		$page="admin_add_domin.htm";
		break;
	}
	case "msg":
	{
		if(!empty($_GET['nohead']))
			$nohead=true;
		$page="admin_msg.htm";
		break;
	}
	case "m":
	{
		include("module/".$_GET['m']."/".$_GET['s'].".php");
		$tpl->template_dir=$config['webroot']."/templates/".$config['temp']."/";
		break;
	}
	default:
	{
		include_once("includes/plugin_payment_class.php");
		include_once("includes/plugin_user_class.php");
		include_once("includes/plugin_msg_class.php");
		$py=new payment();$user=new user();$msg=new msg();
		
		$tpl->assign("shopurl",$user->user_shopurl($buid));
		$tpl->assign("point",$p=$py->point_ranks());		
		$tpl->assign("mailNum",$msg->getMailNum());
		$tpl->assign("uvlist",$admin->who_view_myshop($buid));
		//-------以下是会员办公室的信息---------------------
		$cominfo=$user->get_user_detail($buid);
		$admin->tpl->assign("cominfo",$cominfo);
		//-----------------------------------------------
		$page="admin_main.htm";
		break;
	}
}
//==============================================
include("lang/".$config['language']."/user_admin/global.php");
include("lang/".$config['language']."/admin_menu.inc.php");
@include("lang/".$config['language']."/user_admin/".$action.".php");
$tpl->assign("lang",$lang);
include_once("footer.php");

if(isset($lang[$action]))
	$admin -> tpl -> assign("guide",$lang[$action]);
if(!empty($nohead))
	$tpl->display($page);
else
{
	if(!empty($output))
		$tpl->assign("output",$output);
	else
		$tpl->assign("output",$admin -> tpl -> fetch($page));
	$tpl->display("admin_inc.htm");
}
?>