<?php
$menu['info']['sub'][20]=	array(
						'module'=>'album',
						'name'=>$lang['album'],
						'action'=>array(
							'?action=m&m=album&s=admin_album&menu=info'=>$lang['up_pic'],
							'?action=m&m=album&s=admin_album_cat&menu=info'=>$lang['album_cat'],
						),
					);
//==================================
$mem[5][1][]=array(
	'Альбом',
	array(
		'album.php,1,album',
	)
);
?>