<?php
if($config['language']=='cn')
{
	$menu['info']['sub'][4]=	array(
							'module'=>'brand',
							'name'=>$lang['my_brand'],
							'action'=>array(
								'?action=m&m=brand&s=admin_brand&menu=info'=>$lang['add_brand'],
								'?action=m&m=brand&s=admin_brand_list&menu=info'=>$lang['mg_brand'],
							),
						);
}
//=====================管理员后台===============
$mem[5][1][]=array(
	'Бренды',
	array(
		'add_brand.php,1,brand,Добавить бренд',
		'brand_list.php,1,brand,Список брендов'
	)
)
?>