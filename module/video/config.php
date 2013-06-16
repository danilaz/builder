<?php

//=====================用户商铺==================

//$shopconfig['menu'][6]=array(

	//'menu_show'=>'1','menu_name'=>$lang['video_list'],'menu_link'=>'video_list','module'=>'video'

//);

//=====================用户中心===================

//$menu['info']['sub'][]=	array(
						//'module'=>'video',
					//	'name'=>$lang['video'],
						//'action'=>array(
							//'?action=m&m=video&s=admin_video&menu=info'=>$lang['add_video'],
							//'?action=m&m=video&s=admin_video_list&menu=info'=>$lang['mg_video'],
					//	),
				//	);

//=====================管理员后台===============

$mem[5][1][]=array(

	'Видео',

	array(

		'video_cat.php,1,video,Категории',

		'video_add.php,1,video,Добавить видео',

		'video_list.php,1,video,Управление',

		'video_edit.php,video,0',

	)

)

?>