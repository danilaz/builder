<?php
$menu=array(
	'main'=>array(
			'name'=>'管理首页',
			'action'=>'main',
			'sub'=>array(
				array(
						'name'=>'Quick Link',
						'action'=>array(
						'?action=admin_personal&menu=user'=>'Edit Profile',
						'?action=myshop&menu=user'=>'Company infomation',
						'??action=m&m=offer&s=admin_offer&menu=info'=>'Add New Offer',
						'?action=m&m=offer&s=admin_offer_list&menu=info'=>'Offer List',
						'?action=admin_mail_list&type=inbox&menu=inquire'=>'Inbox',
						'?action=admin_mail_list&type=outbox&menu=inquire'=>'Outbox',
						),
					),
				),
		),
	'usershop'=>array(
		'name'=>'旺铺设置',
		'action'=>'myshop',
		'sub'=>array(
				array(
						'name'=>'My Profile',
						'action'=>array('admin_personal'=>'Profile','setpassword'=>'Change Password'),
					),
				array(
					'name'=>'Company infomation',
					'action'=>array(
						'myshop'=>'Company infomation',
						'?action=cominfo&type=1&mname=Company infomation'=>'Company Detail',
						'?action=cominfo&type=2&mname=Company infomation'=>'发展历程',
						'?action=cominfo&type=3&mname=Company infomation'=>'组织架构',
						'?action=cominfo&type=4&mname=Company infomation'=>'成功案例',
						'template'=>'Template Settings',
						'admin_shop_set'=>'Home Page Set',
						'business_info'=>'Business Info'
					),
					
				),
				array(
					'name'=>'Web Links',
					'action'=>array('admin_link'=>'Add link','admin_link_list'=>'Links List'),
				),
			),	
	),
	'user'=>array(),
	'info'=>array(
			'name'=>'信息管理',
			'action'=>'m&m=offer&s=admin_offer',
		),
	'trade'=>array(
			'name'=>'交易管理',
			'action'=>'m&m=product&s=admin_buyorder',
			'sub'=>array(
					array(
						'name'=>'My Account',
						'action'=>array(
							'admin_accounts_base'=>'Account Info',
							'admin_accounts_cashflow'=>'Cash Flow',
							'admin_accounts_pay'=>'Account Pay',
							'admin_accounts_pickup'=>'Account Pickup',
						),
					)
				),	
		),
	'inquire'=>array(
			'name'=>'商机管理',
			'action'=>'admin_mail_list&type=inbox',
			'sub'=>array(
					array(
						'name'=>'Message Center',
						'action'=>array(
						'admin_mail_list&type=inbox'=>'Inbox',
						'admin_mail_list&type=outbox'=>'Sent Box',
						'admin_mail_list&type=savebox'=>'Saved Box',
						'admin_mail_list&type=delbox'=>'Trash',
						),
					),
					array(
						'name'=>'Manage Subscribe',
						'action'=>array('admin_subscribe'=>'Subscribe List','myfavorite'=>'My Favorite'),
					),
			),	
		),
	'service'=>array(
			'name'=>'收费服务',
			'action'=>'admin_upgrade_group',
			'sub'=>array(
				array(
					'name'=>$lang['up_group'],
					'action'=>array(
					'admin_upgrade_group'=>'Membership upgrade',
					'admin_buy_point'=>$lang['buy_point'],
					 $config['weburl'].'/ads_services.php'=>'Buy Ads',
					),
				),
			),	
		),

);
//----------------------------------------
$dir=$config['webroot'].'/module/';
$handle = opendir($dir); 
while($filename = readdir($handle))
{ 
	if($filename!="."&&$filename!="..")
	{
	  if(file_exists($dir.$filename.'/config.php'))
	  { 
		 include("$dir/$filename/config.php");
	  }
   }
}
//------------------------------------------
$_GET['menu']=isset($_GET['menu'])?$_GET['menu']:'main';
$tpl->assign("submenu",$menu[$_GET['menu']]);
$tpl->assign("menu",$menu);
?>