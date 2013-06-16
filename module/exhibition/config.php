<?php
//===================管理员后台===========
if($config['language']=='cn')
//{
	//$menu['info']['sub'][]=array(
						//'module'=>'news',
						//'name'=>'Выставки',
					//		'action'=>array('?action=m&m=exhibition&s=admin_exhibition&menu=info'=>'Добавить выставку',
						//	'?action=m&m=exhibition&s=admin_exhibition_list&menu=info'=>'Все выставки',
						//	),
					//	);
//}

$mem[5][1][]=array(
	'Выставки',
	array(
		'edit_show_room.php,1,exhibition,Выставочный центр',
		'show_room.php,1,exhibition,Список центров',
		'exhibit.php,1,exhibition,Создать выставку',
		'exhibitlist.php,1,exhibition,Список выставок',
	)
);
?>