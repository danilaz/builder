<?php
include_once("includes/global.php");
include_once("includes/smarty_config.php");
include_once("includes/user_shop_class.php");
include_once("includes/point_inc.php");
//===============================================
$id=$_GET['id']=empty($_GET['id'])?NULL:$_GET['id'];
$list_type=empty($_GET['list_type'])?NULL:$_GET['list_type'];
$cat=empty($_GET['cat'])?NULL:$_GET['cat'];
$catid=$_GET['catid']=empty($_GET['catid'])?NULL:$_GET['catid'];
$_GET['firstRow']=empty($_GET['firstRow'])?NULL:$_GET['firstRow'];
$action=isset($_GET['action'])?$_GET['action']:NULL;

if($action=='prod')
	user_read_rec($buid,$id,1);//记录会员查看产品
else
	user_read_rec($buid,$_GET['uid'],3);//记录会员查看商铺
			
$shop = new shop();
if(isset($_GET['spread'])&&is_numeric($_GET['spread']))
	$shop->site_spread($_GET['spread']);
	
$flag=md5($action.$_GET['uid'].$id.$_GET['firstRow'].$config['weburl'].$catid.$list_type.$cat);
if($action!="mail"&&$action!="comments"&&empty($_GET['template'])&&$buid!=$_GET['uid'])
{	
	$dir=get_userdir($_GET['uid']);//根据会员ID生成缓存目录
	useCahe('shop/'.$dir,true);
}
if(!$tpl->is_cached("space_temp_inc.htm",$flag))
{	
	$company=$shop->user_detail($_GET['uid']);
	if($company['ifpay']<=1) msg($config['weburl'].'/404.php');
	
	//--------------------------------------------
	$config_file=$config['webroot']."/config/shop_config/shop_config_".$_GET['uid'].'.php';
	if(file_exists($config_file))
		include_once($config_file);				
	else
		include_once($config['webroot']."/lang/".$config['language']."/user_admin/shop_default_config.php");
	$tpl->assign("shopconfig",$shopconfig);
	
	//-------------------------------------
	$tpl->assign("ulink",$shop->get_user_link());
	$tpl->assign("custom_cat",$shop->get_custom_cat_list(1));
	$tpl->assign("business_validate_statu",$bst=$shop->get_business_validate());
	if($bst==1) $tpl->assign("bus",$shop->business_info_detail());
			
	switch ($action){
			case "comments":
			{		     
				 $shop->comments_submit();
				 $tpl->assign("uname",$shop->comments_user());
				 $tpl->assign("liebiao",$shop->comments());
				 $page="space_comments.htm";
				 break;
			}
			case "mail":
			{
				if(!empty($_GET['tid'])&&is_array($_GET['tid']))
					$tid=implode(',',$_GET['tid']);
				elseif(!empty($_GET['tid']))
					$tid=$_GET['tid'];
				if(!empty($tid))
				{
					$sql="select id,pname from ".PRO." WHERE id in ($tid)";
					$db->query($sql);
					$res=$db->getRows();
					$tpl->assign("res",$res);
					$tpl->assign("tid",$tid);
				}
				if(!empty($_POST['submit']))
				{	
					if(strtolower($_POST['yzm'])!=strtolower($_SESSION['auth']))
						msg("shop.php?action=mail&uid=$_GET[uid]&type=3");
					include_once("includes/plugin_msg_class.php");
					$msg=new msg();
					$res=$msg->send_email();
					if(!empty($_POST['isflow'])&&$res)
						msg("api/mail_box.php?uid=".$_POST['toid']."&type=1");
					elseif($res)
						msg("shop.php?action=mail&uid=$_GET[uid]&type=1");
					else
						msg("shop.php?action=mail&uid=$_GET[uid]&type=2");
				}
				$tpl->assign("keyword",$company['company']);
				$tpl->assign("title",$company['company']);
				$tpl->assign("description",$company['company']);
				$page  ="space_send_mail.htm";
				break;
			}
			case "album":
			{
				include_once("module/album/includes/plugin_album_class.php");
				$album=new album();
				$re = $album->shop_album_list();
				$tpl->assign("album",$re);
				$tpl->assign("keyword",$company['company']);
				$tpl->assign("title",$company['company']);
				$tpl->assign("description",$company['company']);
				$page  ="space_album_list.htm";
				break;
			}
			case "albumd":
			{
				include_once("module/album/includes/plugin_album_class.php");
				$album=new album();
				$re=$album->shop_album_detail();
				$tpl->assign("de",$re);
				$page  ="space_album_detail.htm";
				break;
			}
			default:
			{
				//module分发
				if(!empty($_GET['m'])&&!empty($_GET['action']))
				{
					include_once("lang/".$config['language']."/user_space/global.php");
					include("module/".$_GET['m']."/space_".$_GET['action'].".php");
				}
				else
				{
					include_once("module/product/includes/plugin_pro_class.php");
					$product=new pro();
					$tpl->assign("rec_pro",$product->get_user_home_pro());
					
					$company_detail=$shop->get_user_detail($_GET['uid']);
					if(is_array($company_detail))
						$company=array_merge($company_detail, $company);
					$tpl->assign("title",$company['company']);
					$tpl->assign("keyword",$company['company'].','.$company['main_pro']);
					$tpl->assign("description",$company['intro']);
					$page  ="space_company.htm";
				}
			}
		}
		//==================语言包====================
		include_once("lang/".$config['language']."/lang_login.php");
		include_once("lang/".$config['language']."/user_space/global.php");
		$lang_file=$config['webroot']."/lang/".$config['language']."/user_space/".$action.".php";
		if(file_exists($lang_file))
			include_once($lang_file);
		else
			include_once("lang/".$config['language']."/user_space/company.php");
		$tpl->assign("lang",$lang);
		//--------------------------------------------
		 $_GET['uid'] = intval($_GET['uid']); 
		if($_GET['uid'] > 0) {
		 $sql="select a.tel,a.logo AS 'avatar' from ". $config['table_pre'] ."user_all a left join ". $config['table_pre'] ."user b ON a.userid = b.userid WHERE a.userid = $_GET[uid]";
		 $db->query($sql);
		 $res=$db->getRows();
		 $ar['usertel'] = $res[0]['tel'];
		 $ar['avatar'] = $res[0]['avatar']; 
		 $company=array_merge($ar, $company); 
		}
		$tpl->assign("com",$company);
		include_once("footer.php");
		//---------------------------------------------
		if(!empty($_GET['template']))
		{
			if(file_exists($config['webroot']."/templates/$_GET[template]"))
				$company['template']=$_GET['template'];
		}
		//如果不设置的话使用系统默认的非模板形式商铺，如果设置了，使用指定商铺模板。
		if(!empty($company['template']))
		{	
			$tpl -> template_dir = $config['webroot'] . "/templates/".$company['template']."/";
			$tpl -> compile_dir = $config['webroot'] . "/templates_c/".$company['template']."/";
			$tpl -> assign("img","templates/".$company['template']."/img/");
			$config['temp']=$company['template'];
		}
		else
			$tpl->template_dir=$config['webroot']."/templates/".$config['temp']."/";
		//---------------------------------------------------------------
		if(empty($output))
			$tpl->assign("output",$tpl->fetch($page?$page:"space_company.htm",$flag));
		else
			$tpl->assign("output",$output);
}
$tpl ->display("space_temp_inc.htm",$flag);
?>