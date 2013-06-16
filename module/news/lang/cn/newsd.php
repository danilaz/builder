<?php
if(!isset($newsDetail))
	$newsDetail=array();
if(isset($newsDetail["title"]))
	$lang["title"]=$newsDetail["title"];
if(isset($newsDetail["body"]))
	$lang["description"]=csubstr(trim(strip_tags($newsDetail["body"])),23,141);
$newsDetail['catid']=isset($newsDetail['catid'])?$newsDetail['catid']:NULL;
$newsDetail['cat']=isset($newsDetail['cat'])?$newsDetail['cat']:NULL;
$newsDetail['title']=isset($newsDetail['title'])?$newsDetail['title']:NULL;

$lang["guide"]="<a href='../?m=news'>Горячие новости</a> &raquo;<a href='../?m=news&s=news_list&id=".$newsDetail['catid']."'>	".$newsDetail['cat']."</a> &raquo; ".$newsDetail['title'];
$lang['comer']='Источник: ';
$lang['author']='Автор: ';
$lang['read_count']='Читали: ';
$lang['noright']='Ваша группа не может просматривать этот материал....';
$lang['tags']='Теги: ';
$lang['hottags']='Горячие теги';
$lang['recread']='Рекомендованные';
$lang['picnews']='Фото с новостей';

$lang['pubtime']='Размещено: ';
$lang['bigfont']='Увеличить шрифт';
$lang['smallfont']='Уменьшить шрифт';

$lang['fav']='Избранное';
$lang['rewiew']='Отзывы';
$lang['print']='Печать';

$lang['survey']='Обзор';
$lang['closed']='Закрыть';
$lang['voted']='Голосов';
$lang['vote']='Опросы';
$lang['view']='Просмотр';




?>