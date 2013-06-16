<?php
include_once("../../includes/global.php");
include_once("../../includes/admin_class.php");
include_once("../../includes/smarty_config.php");
//===============================================
$action=isset($_GET['action'])?$_GET['action']:NULL;
$admin = new admin();
switch ($action)
{
	case "admin_product_list":
	{
		include_once($config['webroot']."/module/product/includes/plugin_pro_class.php");
		$pro=new pro();
		if(!empty($_GET['rec']))
		{
			echo $pro->rec_pro($_GET['rec'],$_GET['type']);
			die();
		}
		
		if(isset($_GET['update']))
		{
			if($_GET['update']=="all")
				$admin->check_access('refresh_all_pro');
			else
				$pro  ->  update_pro($_GET['update']);
			echo 1;
		}
		break;
	}
}
?>