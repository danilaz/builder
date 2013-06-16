<?php
include_once("$config[webroot]/config/usergroup.php");
$ifpay=$_SESSION['IFPAY'];
$groupname=$group[$ifpay]['name'];
$des=$group[$ifpay]['des'];
//======================================================================
$lang_ext['notice']='Советы:';
$lang_ext['active']='Ваша учетная запись в настоящее время рассматривается, пожалуйста, будьте терпеливы! <br>Вы можете <a href="./main.php?action=myshop">указать более полную информацию</a> или <a href="./aboutus.php?type=3">связаться с нами</a>.';
$lang_ext['access_dine']='Извините, но Ваш уровень членства не позволяет использовать данный функционал!<br />Текущий статус: '.$groupname.'<br>'.$des.'
					 <br><b><a href="main.php?action=admin_upgrade_group" target="_parent">Поднять уровень членства</a> <a href="javascript:history.back();">Вернуться</a></b>';

$lang_ext['reg_next'] = 'Вы можете поднять свой уровень в разделе "Членство". После обновления Вашего уровня Вы сможете:
		 <br /><a href="main.php?menu=user&action=admin_personal">1. Изменить профиль</a>
		 <br /><a href="main.php?action=myshop&info=1&menu=user">2. Улучшить информацию о компании</a>
		 <br /><a href="main.php?action=cominfo&type=1&menu=user">3. Размещать информацию в разделах своего сайта</a>
		 <br /><a href="main.php?action=m&m=offer&s=admin_offer&menu=info">4. Размещать продукцию</a>
		 <br /><a href="main.php?action=m&m=news&s=admin_news&menu=usershop">5. Размещать пресс-релизы, новости компании</a>
		 <br /><a href="main.php?action=m&m=video&s=admin_video&menu=info">6. Публикация видеоматериалов компании</a>';
		 
$lang = array_merge($lang, $lang_ext);
?>