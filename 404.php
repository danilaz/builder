<?php
/**
 * powered by b2bbuilder
 * Coprighty http://www.b2b-builder.com
 * Auter:brad zhang;
 * Des:abouts us
 */
include_once("includes/global.php");
include_once("includes/smarty_config.php");
//================================================
//对注册机的一些判断和处理。
if($buid&&(substr($_SERVER['REQUEST_URI'],0,9)=='/main.php'||$_SERVER['REQUEST_URI']=='/login.php'||$_SERVER['REQUEST_URI']=="/$config[regname]"))
{
	$sql="update ".USER." set ifpay='1' where userid='$buid'";
	$db->query($sql);
	
	include_once("$config[webroot]/config/reg_config.php");
	$config = array_merge($config,$reg_config);
	bsetcookie("USERID",NULL,time(),"/",$config['baseurl']);
	setcookie("USER",NULL,time(),"/",$config['baseurl']);
	unset($_SESSION["IFPAY"]);unset($_SESSION['UTYPE']);
}
//================================================
include_once("footer.php");
$tpl->display("404.htm");
?>