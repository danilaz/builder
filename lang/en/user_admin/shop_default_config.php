<?php
include_once("lang/$config[language]/user_space/global.php");
//====================================================================
$shopconfig['menu']=array(
	1=>array('menu_show'=>'1','menu_name'=>'Home','menu_link'=>''),
	7=>array('menu_show'=>'1','menu_name'=>'Album','menu_link'=>'album'),
	9=>array('menu_show'=>'1','menu_name'=>'Contact Us','menu_link'=>'mail'),
	10=>array('menu_show'=>'1','menu_name'=>'Comments','menu_link'=>'comments'),
);
$dir=$config['webroot'].'/module/';
$handle = opendir($dir); 
while ($filename = readdir($handle))
{ 
	if($filename!="."&&$filename!="..")
	{
	  if(file_exists($dir.$filename.'/config.php'))
	  { 
		 include("$dir/$filename/config.php");
	  }
   }
}
ksort($shopconfig['menu']);

//=========================================================
$shopconfig['side_notice_name'] = 'Company Announcement'; 
$shopconfig['side_notice_show'] = '1'; 
$shopconfig['side_info_name'] = 'Company Information'; 
$shopconfig['side_info_show'] = '1'; 
$shopconfig['side_stat_name'] = 'Statistics'; 
$shopconfig['side_stat_show'] = '1'; 
$shopconfig['side_contact_name'] = 'Contact'; 
$shopconfig['side_contact_show'] = '1'; 
$shopconfig['side_friendlink_name'] = 'Friendly Links'; 
$shopconfig['side_friendlink_show'] = '1'; 
$shopconfig['side_friendlink_nums'] = '5'; 
$shopconfig['side_pro_name'] = 'Products hall'; 
$shopconfig['side_pro_show'] = '1'; 
$shopconfig['side_cret_name'] = 'Authentication'; 
$shopconfig['side_cret_show'] = '1'; 
$shopconfig['side_newoffer_name'] = 'The Laseted Trade'; 
$shopconfig['side_newoffer_show'] = '1'; 
$shopconfig['side_newoffer_nums'] = '5'; 
$shopconfig['home_intro_name'] = 'Company Intro'; 
$shopconfig['home_intro_show'] = '1'; 
$shopconfig['home_recpro_name'] = 'The lasted Product'; 
$shopconfig['home_recpro_show'] = '1'; 
$shopconfig['home_recpro_nums'] = '5'; 
$shopconfig['home_newoffer_name'] = 'The lasted supply'; 
$shopconfig['home_newoffer_show'] = '1'; 
$shopconfig['home_newoffer_nums'] = '5'; 
$shopconfig['home_news_name'] = 'Company News'; 
$shopconfig['home_news_show'] = '1'; 
$shopconfig['home_news_nums'] = '5'; 
$shopconfig['home_honor_name'] = 'Honor'; 
$shopconfig['home_honor_show'] = '1'; 
$shopconfig['home_contact_name'] = 'Contact'; 
$shopconfig['home_contact_show'] = '1'; 
$shopconfig['comintro_leng'] = '1000'; 
$shopconfig['shop_pro_list']='1';
?>