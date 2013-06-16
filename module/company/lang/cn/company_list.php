<?php
$lang["guide"]=isset($cat["cat"])?$cat["cat"]:"Список компаний";
if(empty($cat['cat']))
	$cat['cat']='Все компании';
if(!empty($cat['title']))
	$lang['title']=$cat['title'];
else
	$lang['title']=$dpid.$dcid.$tt."$cat[cat],$cat[cat]Производители,$cat[cat]Продукты,$cat[cat]Уровень";	
if(!empty($cat['keyword']))	
	$lang['keyword']=$cat['keyword'];
else
	$lang['keyword']=$dpid.$dcid."$cat[cat],$cat[cat]Производители,$cat[cat]Продукты,$cat[cat]Уровень";
	
if(!empty($cat['description']))
	$lang['description']=$cat['description'];
else
	$lang['description']=$dpid.$dcid."$cat[cat] Полный каталог $cat[cat]Производители,$cat[cat] Каталог поставщиков и экспортеров $cat[cat] Новости индустрии,$cat[cat] уровень";
$lang['comres']='Компании';
$lang['comlist']='Список компании';
$lang['com_nav']='Навигация';
$lang['user_list']='Список компаний';
$lang['rel_pro']='Обзор сопутствующих товаров';
$lang['email_requir']='Отправить на email';
$lang['no_cominfo']=' Информация не найдена, ';
$lang['reg_user']='Нажмите здесь, чтобы зарегистрироваться и получить бесплатное членство.';
$lang['vip_user']='Лучшие компании';
$lang['last_reg']='Новые компании';
$lang['comcat']='Каталог компаний';
$lang['lookmore']='Посмотреть по стране';
$lang['province']='По регионам';
?>