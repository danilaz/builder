<?php
$menu=array(
	'main'=>array(
			'name'=>'Главная',
			'action'=>'main',
			'sub'=>array(
                                array(
						'name'=>'Обо мне',
						'action'=>array(
							'admin_personal'=>'Мой профиль',
							'setpassword'=>'Пароль',
						),
					),

				array(
						'name'=>'Моя компания',
						'action'=>array(
						//'?action=admin_personal&menu=user'=>'Обо мне',
						'?action=myshop&menu=user'=>'О компании',
						'?menu=usershop&action=template'=>'Шаблоны сайта',
						'?action=m&m=offer&s=admin_offer&menu=info'=>'Добавить продукты',
						'?action=m&m=offer&s=admin_offer_list&menu=info'=>'Все продукты',
						'?action=admin_mail_list&type=inbox&menu=inquire'=>'Входящие',
						'?action=admin_mail_list&type=outbox&menu=inquire'=>'Исходящие',
						//'?action=m&m=friend&s=admin_friends&menu=user'=>'Добавить друзей',
						//'?action=m&m=friend&s=admin_friends_list&menu=user'=>'Все друзья',
						),
					),

           //                     array(
			//			'name'=>'Мои контакты',
				//		'action'=>array(
					//		'add_friend'=>'Добавить друзей',
						//	'friend_list'=>'Все друзья',
					//	),
				//	),
				),
		),
	'user'=>array(
			'name'=>'Профиль',
			'action'=>'myshop',
			'sub'=>array(
					array(
						'name'=>'Обо мне',
						'action'=>array(
							'admin_personal'=>'Мой профиль',
							'setpassword'=>'Пароль',
						),
					),
					array(
						'name'=>'Моя компания',
						'action'=>array(
							'myshop'=>'Профиль компании',
							'?action=cominfo&type=1&menu=user'=>'О компании',
							'?action=cominfo&type=2&menu=user'=>'История',
							'?action=cominfo&type=3&menu=user'=>'Структура',
							'?action=cominfo&type=4&menu=user'=>'Достижения',
							//'business_info'=>'Данные о бизнесе',
						),
					),
				),	
		),
	'info'=>array(
			'name'=>'Продукты',
			'action'=>'m&m=offer&s=admin_offer&menu=info',
		),
	'trade'=>array(
			//'name'=>'Сделки',
			//'action'=>'m&m=product&s=admin_buyorder',
                        'name'=>'Счет',
                        'action'=>'admin_accounts_base&menu=trade',
			'sub'=>array(
					'1'=>array(
						'name'=>'Счет',
						'action'=>array(
						'admin_accounts_base'=>'Инфо о счете',
						//'admin_accounts_cashflow'=>'Движение средств',
						'admin_accounts_pay'=>'Пополнение счета',
						//'admin_accounts_pickup'=>'Вывод средств',
						),
					)
				),	
		),
	'inquire'=>array(
			'name'=>'Почта',
			'action'=>'admin_mail_list&type=inbox',
			'sub'=>array(
					array(
						'name'=>'Моя почта',
						'action'=>array(
						'admin_mail_list&type=inbox'=>'Входящие',
						'admin_mail_list&type=outbox'=>'Исходящие',
						'admin_mail_list&type=savebox'=>'Сохраненные',
						'admin_mail_list&type=delbox'=>'Рассылка',
						),
					),
					array(
						'name'=>'Доставка',
						'action'=>array('admin_subscribe'=>'Подписка','myfavorite'=>'Избранное'),
					),
			),	
		),
	//'service'=>array(
			//'name'=>'Членство',
			//'action'=>'admin_upgrade_group',
			//'sub'=>array(
				//array(
					//'name'=>'Членство',
					//'action'=>array(
					//'admin_upgrade_group'=>'Поднять уровень',
					//'admin_buy_point'=>'Покупка баллов',
					//$config['weburl'].'/ads_services.php'=>'Покупка рекламы',
					//),
				//),
			//),	
		//),
	'usershop'=>array(
		'name'=>'Настройки',
		'action'=>'template',
		'sub'=>array(
				array(
					'name'=>'Настройки',
					'action'=>array(
						'template'=>'Выбор шаблона',
						'admin_shop_set'=>'Настройка шаблона',
						'add_domin'=>'Привязка домена'
					),
				),
				array(
					'name'=>'Ссылки',
					'action'=>array('admin_link'=>'Создать ссылку','admin_link_list'=>'Все ссылки'),
				),
			),	
	),

);
//----------------------
$dir=$config['webroot'].'/module/';
$handle = opendir($dir); 
while ($filename = readdir($handle))
{ 
	if($filename!="."&&$filename!="..")
	{
	  if(file_exists($dir.$filename.'/config.php'))
	  { 
		 include("$dir/$filename/config.php");
	  }
   }
}
foreach($menu as $key=>$v)
{
	ksort($menu[$key]['sub']);
}
//----------------------
$_GET['menu']=isset($_GET['menu'])?$_GET['menu']:'main';
$tpl->assign("submenu",$menu[$_GET['menu']]);
$tpl->assign("menu",$menu);
?>