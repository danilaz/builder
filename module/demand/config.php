<?php
//=====================用户商铺==================
$shopconfig['menu'][3]=array(
	'menu_show'=>'1','menu_name'=>$lang['demand_list'],'menu_link'=>'demand_list','module'=>'demand'
);
//=====================用户中心===================
$menu['info']['sub'][2]=	array(
						'module'=>'demand',
						'name'=>$lang['my_demand'],
						'action'=>array(
						 //'?action=m&m=product&s=admin_product_cat&menu=info'=>$lang['pro_cat'],
							'?action=m&m=demand&s=admin_demand&menu=info'=>$lang['add_demand'],
							'?action=m&m=demand&s=admin_demand_list&menu=info'=>$lang['mg_demand'],
							//'?action=m&m=product&s=admin_product_list&menu=info'=>'Онлайн торговля',
							//'?action=m&m=product&s=admin_product_batch&menu=info'=>'Массовая загрузка', 
							
						),
					);
//=====================管理员后台==================
$mem[5][1][]=array(
	'Спрос',
	array(
		'demandlist.php,1,demand,Управление продуктами',
		'demandmod.php,0,demand,Изменить продукты',
	)
)
?>