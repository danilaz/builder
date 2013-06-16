<?php
$mem = array(
	array
	(
		lang_show('system_setting'),
		array
		(
			array(
				lang_show('system_setting'),
				array(
					'system_config.php,1',
					'seo_config.php,1',
					'reg_config.php,1',
					'user_reg_verf.php,1',
					'mail_config.php,1',
					'nav_menu.php,1',
					'web_con_type.php,1',
					'payment.php,1',
					'watermark_config.php,1',
					'add_sub_domain.php,1',
					'sub_domain_list.php,1',
					'uc_config.php,1',
					//'home_config.php,1',
					'search_word.php,1',
					'express.php,0',
					'web_con_set.php,0',
				)
			),
			array(
				'Регионы',
				array(
					'country.php,1',
					'province.php,1',
					'city.php,1',
				)
			),	
		)
	),
	array
	(
		lang_show('account_manager'),
		array
		(
			array(
				lang_show('account_manager'),
				array(
					'group.php,1',
					'group_list.php,1',
					'add_admin_manager.php,1',
					'admin_manager.php,1',
					'modpass.php,1',
					'operate_log.php,1',
				)
			)
		)
	)
	,
	array
	(
		lang_show('toolbar'),
		array
		(
			array(
				lang_show('toolbar'),
				array(
					'clearcahe.php,1',
					'crons.php,1',
					'iplockset.php,1',
					'add_filter_keyword.php,1',
					'filter_keyword_list.php,1',
					'up_db.php,1',
					'db_export.php,1',
					'optimizetable.php,1',
				)
			),
			array(
				'Статистика',
				array(
					'page_view.php,1',
					'all_page_rec.php,1',
				)
			),
		)
	)
	,
	array
	(
		lang_show('type_manager'),
		array
		(
			array(
				lang_show('type_manager'),
				array(
					'pro_info_add_cat.php,1',
					'pro_info_cat.php,1',
					'pro_info_add_field.php,1',
					'comments_list.php,1',
				)
			),		
		)
	)
	,
	array
	(
		lang_show('member_manager'),
		array
		(
			array(
				'Пользователи',
				array(
						'member.php,1',
						'merge_user.php,1',
						'membergroup.php,1',
						'point_config.php,1',
						'feedback.php,1',
						'user_read_rec.php,1',
						'user_domin.php,1',
						'reserve_username.php,1',
						'user_template.php,1',
						'send_mail_back.php,0',
						'to_login.php,0',
						'membermod.php,0',
					)
			  ),
			  array(
				  'Контент',
				  array(
						'tag_manage.php,1',
						'business_info_list.php,1',
						'user_rewiew.php,1',
						'hy_feedback.php,1',
				  )
			  ),
			 array(
				  'Средства',
				  array(
						'member_charge.php,1',
						'pickuplist.php,1',
						'bank_account.php,1',
				  )
			  ),
		)
	)
	,
	array
	(
		lang_show('article_manager'),
		array
		(
		)
	),

	array
	(
		lang_show('advm'),
		array
		(
			array(
				'Реклама',
				array(
					'advs.php,1',
					'edit_adv.php,1',
				)
			),
			array(
				'Ссылки',
				array(
					'add_link.php,1',
					'link.php,1',
					'advs_con_list.php,0',
					'edit_adv_con.php,0'
				)
			),
			array(
			  	'Шаблоны почты',
				array(
					'mailmod.php,1',
					'massmail.php,1',
					'mail_send.php,0',
				)
			  ),
			array(
				'Спец-темы',
				array(
					'special_list.php,1,special,Список тем',
					'add_special.php,1,special,Создание темы',
					'special_con.php,0,special,Комбинации',
					'modules_con_set.php,0,special,Параметры',
				)
			  ),
		)
	)

);

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



?>