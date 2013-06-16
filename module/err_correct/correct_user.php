<?php
//============================================
if($_POST['action']=='user_correct'&&!empty($_POST['userid']))
{
	 $sql="insert into ".USEREC."
		(userid,fromuser,position,mobile,contact,province,city,addr,tel,fax,zip,url,ctime)
		VALUES
		('$_POST[userid]','$_POST[fromuser]','$_POST[position]','$_POST[mobile]','$_POST[contact]','$_POST[province]','$_POST[city]','$_POST[addr]','$_POST[tel]','$_POST[fax]','$_POST[zip]','$_POST[url]','".time()."')";

	$db->query($sql);
	if($db->lastid()>0){
		echo "<font size=2>Успешно отправлено! Окно автоматически закроется через 3 секунды ...</font>";
		echo "<script>setTimeout(\"parent.window.close_win()\",3000);</script>";
		die;
	}
	else
		echo "Корректировка отправлена!";
}
else
{
	include_once("lang/".$config['language']."/lang_login.php");
	include_once("lang/".$config['language']."/user_space/global.php");
	include_once("lang/".$config['language']."/user_space/company.php");
	$tpl->assign("lang",$lang);
	//--------------------------------------------
	include_once($config['webroot']."/lang/".$config['language']."/user_admin/shop_default_config.php");
	$tpl->assign("shopconfig",$shopconfig);
	//--------------------------------------------
	include_once("includes/user_shop_class.php");
	$shop = new shop();
	$company=$shop->user_detail($_GET['uid']);
	$tpl->assign("com",$company);


	//------------------------------------------
	$tpl->assign("current","err_correct");
	include_once("footer.php");
	$out=tplfetch("correct_user.htm",null,true);
}
?>