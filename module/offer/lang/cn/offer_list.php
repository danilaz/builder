<?php
$lang["guide"]=isset($guide)?$guide:"Список продуктов";

if(!empty($cat['title']))
	$lang['title']=$cat['title'];
else
	$lang['title']=$dpid.$dcid.$tt."$cat[cat],$cat[cat] Производители, $cat[cat] продуктов, $cat[cat] торговых сделок сделок";	
if(!empty($cat['keyword']))	
	$lang['keyword']=$cat['keyword'];
else
	$lang['keyword']=$dpid.$dcid."$cat[cat],$cat[cat]Производители, $cat[cat] продуктов,$cat[cat] тоговых сделок";
	
if(!empty($cat['description']))
	$lang['description']=$cat['description'];
else
	$lang['description']=$dpid.$dcid."$cat[cat] для профессионального каталога продукции $cat[cat] производителей $cat[cat] поставщиков и покупателей $cat[cat] всех отраслей промышленности, а также $cat[cat]";

$lang['cat_nav']='Навигация по разделу';
$lang['rec_offer']='Рекомендованный продукт';
$lang['new_offer']='Новые товары';
$lang['offer_list']='Список продуктов';
$lang['now_requier']='Связаться';
$lang['browse_more']='Другие страны';
$lang['offercat']='Каталог продукции';
$lang['browse_more']='Подробнее';
?>