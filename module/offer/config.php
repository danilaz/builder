<?php
//=====================用户商铺==================
$shopconfig['menu'][2]=array(
	'menu_show'=>'1','menu_name'=>$lang['offer_list'],'menu_link'=>'offer_list','module'=>'offer'
);
//=====================用户中心===================
$menu['info']['sub'][1]=	array(
						'module'=>'offer',
						'name'=>$lang['my_offer'],
						'action'=>array(
							//'?action=m&m=product&s=admin_product_cat&menu=info'=>$lang['pro_cat'],
							'?action=m&m=offer&s=admin_offer&menu=info'=>$lang['add_offer'],
							'?action=m&m=offer&s=admin_offer_list&menu=info'=>$lang['mg_offer'],
							//'?action=m&m=product&s=admin_product_list&menu=info'=>'Онлайн торговля',
							//'?action=m&m=product&s=admin_product_batch&menu=info'=>'Массовая загрузка',
						),
					);

$menu['info']['sub'][3]=	array(
						'module'=>'offer',
						'name'=>'Общее',
						'action'=>array(
							'?action=m&m=product&s=admin_product_cat&menu=info'=>$lang['pro_cat'],
							//'?action=m&m=product&s=admin_product_batch&menu=info'=>'Массовая загрузка', 
							
						),
					); 

//=====================管理员后台==================
$mem[5][1][]=array(
	'Предложение',
	array(
		'offerlist.php,1,offer,Управление продуктами',
		'offermod.php,0,offer,Изменить продукты',
	)
)
?>