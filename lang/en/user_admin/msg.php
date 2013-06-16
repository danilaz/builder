<?php
include_once("config/usergroup.php");
$ifpay=$_SESSION['IFPAY']['name'];
$groupname=$group[$ifpay]['name'];
$des=$group[$ifpay]['des'];
//======================================================================

$lang_ext['notice']='Notice:';
$lang_ext['active']='your account under review, please wait for administrator approval, or take the initiative to 
			 contact with the administrators';
$lang_ext['access_dine']='your authority is limited:
			<br /> you for the current identity: '. $ifpay.'
			<br /> '.$des.'
			<br /> <a href="main.php?action=admin_upgrade_group" target="_parent"> Click here for advanced Members trial, please </ a>';

$lang_ext['reg_next'] = 'Your Company profile has been updated successfully. You can now:
			<br /> <a href="main.php?action=myshop&info=1"> 1. Continue to edit profile </ a>
			<br /> <a href="main.php?action=template"> 2. Select shop template  </ a>
			<br /> <a href="main.php?action=m&m=offer&s=admin_offer"> 3. Post Product information </ a>
			<br /> <a href="main.php?action=m&m=news&s=admin_news&menu=usershop"> 4. Post Company News </ a>
			<br /> <a href="main.php?action=m&m=video&s=admin_video&menu=info"> 5. Post Company Video </ a> ';
$lang = array_merge($lang, $lang_ext);
?>