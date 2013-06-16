<?php
/**
 * Powered by B2Bbuilder
 * Copright http;//www.b2b-builder.com
 */
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_USER_ERROR|E_USER_WARNING);//6143
header('Content-Type: text/html; charset=utf-8');
if(@function_exists('date_default_timezone_set'))
	@date_default_timezone_set('Europe/Kiev');

$config['version']='B2Bbuilder_v6.602.20120202';
$config['webroot']=substr(dirname(__FILE__), 0, -9);
ini_set('include_path',$config['webroot'].'/');

include_once($config['webroot']."/config/config.inc.php");
include_once($config['webroot']."/config/web_config.php"); 
include_once($config['webroot']."/config/table_config.php"); 
include_once($config['webroot']."/includes/db_class.php");  
include_once($config['webroot']."/includes/function.php");
include_once($config['webroot']."/config/uc_config.php");

$db=new dba($config['dbhost'],$config['dbuser'],$config['dbpass'],$config['dbname']);

magic();//魔术调用
?>