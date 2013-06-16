<?php
include("$config[webroot]/lang/$config[language]/user_space/global.php");
//=======================================以下商铺菜单默认值
$shopconfig['menu']=array(
	1=>array('menu_show'=>'1','menu_name'=>'Главная','menu_link'=>''),
	7=>array('menu_show'=>'1','menu_name'=>'Галерея','menu_link'=>'album'),
	9=>array('menu_show'=>'1','menu_name'=>'Контакты','menu_link'=>'mail'),
	10=>array('menu_show'=>'1','menu_name'=>'Комментарии','menu_link'=>'comments'),
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
ksort($shopconfig['menu']);
//======================================================
$shopconfig['side_notice_name']='Объявления';
$shopconfig['side_notice_show']='1';
$shopconfig['side_info_name']='Информация о компании';
$shopconfig['side_info_show']='1';
$shopconfig['side_stat_name']='Статистика';
$shopconfig['side_stat_show']='1';
$shopconfig['side_contact_name']='Контактное лицо';
$shopconfig['side_contact_show']='1';
$shopconfig['side_friendlink_name']='Сссылки друзей';
$shopconfig['side_friendlink_show']='1';
$shopconfig['side_friendlink_nums']='5';
$shopconfig['side_pro_name']='Витрина продуктов';
$shopconfig['side_pro_show']='1';
$shopconfig['side_cert_name']='Сертификация';
$shopconfig['side_cert_show']='1';
$shopconfig['side_newoffer_name']='Предложение';
 $shopconfig['side_newdemand_name']='Спрос'; 
$shopconfig['side_newoffer_show']='1';
 $shopconfig['side_newdemand_show']='1'; 
$shopconfig['side_newoffer_nums']='5';
 $shopconfig['side_newdemand_nums']='5'; 
//以上商铺侧边栏默认值


$shopconfig['home_intro_name']='Анонс компании';
$shopconfig['home_intro_show']='1';
$shopconfig['home_recpro_name']='Рекомендованные продукты';
$shopconfig['home_recpro_show']='1';
$shopconfig['home_recpro_nums']='5';
$shopconfig['home_newoffer_name']='Новые предложения';
$shopconfig['home_newdemand_name']='Новый спрос'; 
$shopconfig['home_newoffer_show']='1';
$shopconfig['home_newdemand_show']='1'; 
$shopconfig['home_newoffer_nums']='5';
$shopconfig['home_newdemand_nums']='5'; 
$shopconfig['home_news_name']='Новости компании';
$shopconfig['home_news_show']='1';
$shopconfig['home_news_nums']='5';
$shopconfig['home_honor_name']='Медали';
$shopconfig['home_honor_show']='1';
$shopconfig['home_contact_name']='Контакты';
$shopconfig['home_contact_maps']='Мы на карте';

$shopconfig['home_contact_show']='1';
//以上商铺首页默认值

$shopconfig['comintro_leng']='1000';
$shopconfig['shop_pro_list']='1';
?>