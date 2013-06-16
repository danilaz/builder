<?php
//=======================用户商铺===============
//$shopconfig['menu'][4]=array(
	 //'menu_show'=>'1','menu_name'=>'Онлайн торговля','menu_link'=>'product_list','module'=>'product', // 'menu_show'=>'1','menu_name'=>//$lang['pro_list'],'menu_link'=>'product_list','module'=>'product',
//);
//=====================用户中心===================
//$menu['trade']['sub'][0]= array(
						//'module'=>'product',
						//'name'=>$lang['manorder'],
						//'action'=>array(
							//'?action=m&m=product&s=admin_buyorder&menu=trade'=>$lang['mybuy'],
							//'?action=m&m=product&s=admin_sellorder&menu=trade'=>$lang['mysell'],
					//	),
					//);
//=====================管理员后台==================
$mem[5][1][]=array(
	'Молл',
	array(
		'prolist.php,1,product,Управление Mall',
		'cpmod.php,0,product,Изменить продукты',
		'user_order.php,1,product,Управление заказами',
	)
)
?>