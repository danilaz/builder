<?php
if(preg_match('/(mozilla|m3gate|winwap|openwave)/i', $_SERVER['HTTP_USER_AGENT']))
{
	//header("Location: ../index.php");
}
include_once("../includes/global.php");
include_once("inc/wap_function.php");
wapheader($config['company'],$config['weburl']);
if (!empty($_GET["action"]))
$action=$_GET["action"];
else
$action="home";
//$action=empty($action)?"home":$_GET["action"];
//===============================
if(in_array($action, array('home','offer_cat','offer_list','offer_detail','product_cat','product_list','product_detail','news_cat','news_list','news_detail','corporate_cat','corporate_list','corporate_detail','search','corporate_moredetail','product_showimg')))
{
	require'inc/'.$action.'.php';
}
else
{
	die('undefined');
}
//===============================
wapfooter();
?>