<?php
//=====================用户商铺==================
$shopconfig['menu'][5]=array(
	'menu_show'=>'1','menu_name'=>$lang['news_list'],'menu_link'=>'news_list','module'=>'news',
);
//=====================用户中心==================
$menu['usershop']['sub'][]=	array(
						'module'=>'offer',
						'name'=>$lang['my_news'],
						'action'=>array(
							'?action=m&m=news&s=admin_news&menu=usershop'=>$lang['add_news'],
							'?action=m&m=news&s=admin_news_list&menu=usershop'=>$lang['mg_news'],
						),
					);

//=====================管理员后台===============
$mem[7]= array("Новости");
$mem[7][1][]=array(
	'Новости системы',
	array(
		'news_step.php,1,news,Создать новость',
		'news.php,0,news,Пресс релизы',
		'newscat.php,1,news,Категории',
		'news_module.php,1,news,Шаблоны',
	),	
);
$arr[0]='newslist.php,1,news,Список новостей';
$sql="select catid,cat from ".NEWSCAT." where pid=0 order by nums asc";	
$db->query($sql);
$re=$db->getRows();
foreach($re as $key=>$val)
{
	$arr[$key+1]="newslist.php&classid=$val[catid],1,news,$val[cat],";	
}

$mem[7][1][]=array('Управление',$arr);
	

?>