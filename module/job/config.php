<?php
if($config['language']=='cn')
{
	//=====================用户商铺==================
	//$shopconfig['menu'][8]=array(
		//'menu_show'=>'1','menu_name'=>$lang['hr_list'],'menu_link'=>'job_list','module'=>'job'
	//);
	//=====================用户中心===================

        //$menu['usershop']['sub'][]=	array(
							//'module'=>'job',
							//'name'=>$lang['hr'],
							//'action'=>array(
								//'?action=m&m=job&s=admin_job&menu=usershop'=>$lang['add_hr'],
								//'?action=m&m=job&s=admin_job_list&menu=usershop'=>$lang['mg_hr'],
								//'?action=m&m=job&s=admin_resume_inbox&menu=usershop'=>$lang['inbox'],
							//),
						//);
	
	//$menu['user']['sub'][]=	array(
							//'module'=>'job',
							//'name'=>$lang['rs_mg'],
							//'action'=>array(
								//'?action=m&m=job&s=admin_resume&menu=user'=>$lang['add_rs'],
								//'?action=m&m=job&s=admin_resume_list&menu=user'=>$lang['mg_rs'],
							//),
						//);

	//=====================管理员后台===============
	$mem[5][1][]=array(
		'Вакансии',
		array(
			'hrcat.php,1,job,Настройка категорий',
			'mg_job_list.php,1,job,Список вакансий',
			'jobmod.php,0,job,Рабочие места',
		)
	);
}
?>