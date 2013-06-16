<?php
if(isset($_COOKIE["USER"]))
	$log["myoffice"]="<font color='red'>Здравствуйте, ".$_COOKIE["USER"]."!</font>";

$log['new_msg']='Новые сообщения';
$log["sigin"]="Присоединиться";
$log["logout"]="Выход ";
$log["login"]="Войти ";
$log["logtitle"]="Вход для участников";
$log["username"]="Пользователь";
$log["pass"]="Пароль";
$log["lostpass"]="Забыли пароль?";
$log["wcom"]="Добро пожаловать ";
$log["tady"]="Сегодня: ".date("Y-m-d").". Желаем процветания Вашему бизнесу!";
$log["viepage"]="&raquo;Мой сайт";
$log["enter"]=" &raquo;Мой офис";
$log["inquiry"]="Рассылка";
?>