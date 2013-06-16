<?php
include_once("../includes/global.php"); 
include_once("../includes/page_utf_class.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//====================================
if (empty($_GET['action'])&&empty($_GET['aid'])&&!empty($_POST['submit'])&&!empty($_POST['addid']))
{
   if ($_POST['addid']==99999999)
       $sql="insert into ".MENU." (sort,menu_name,link_addr,type,statu,partent_menu_id,selected_flag,lang) 
	   value('1','$_POST[menu_name]','$_POST[link_addr]',0,1,0,'$_POST[selected_flag]','$config[language]')";
   else
       $sql="insert into ".MENU." (sort,menu_name,link_addr,type,statu,partent_menu_id,lang) 
	   value('1','$_POST[menu_name]','$_POST[link_addr]',0,1,'$_POST[addid]','$config[language]')";
   $db->query($sql);
   msg("nav_menu.php");
}
if (!empty($_GET['action'])&&$_GET['action']=='del'&&!empty($_GET['did'])&&empty($_POST['submit']))
{
	unset($sql);
	$sql="delete from ".MENU." where id=".$_GET['did'];
	$db->query($sql);
	$sql="delete from ".MENU." where partent_menu_id=".$_GET['did'];
	$db->query($sql);
	msg("nav_menu.php");
}
if (!empty($_GET['action'])&&$_GET['action']=='add'&&!empty($_GET['aid'])&&empty($_POST['submit']))
{
	$sql="select * from ".MENU." where id=".$_GET['aid'];
	$db->query($sql);
	$re=$db->fetchRow();
	if (empty($re['menu_name']))
		$topmenu=lang_show('add_top_menu');
	else
		$topmenu=lang_show('add_menu').$re['menu_name'].lang_show('add_next_menu');
}
?>
<HTML>
<head>
<TITLE><?php echo lang_show('nav_config');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript">
function ChkFields() {
if (document.add_nav_menu.menu_name.value=='') {
  window.alert ("<?php echo lang_show('en_cat_name');?>");
  add_nav_menu.menu_name.focus();
  return false
}
}
</script>
</head>
<body>
<div class="guidebox"><?php echo lang_show('nav_config');?> &raquo; <?php echo lang_show('add_nav');?></div>
<div class="bigbox">
	<div class="bigboxhead"><?php echo $topmenu;?></div>
	<div class="bigboxbody">
	<form name="add_nav_menu" action="nav_menu_action.php" method="POST">
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr>
          <td height="20" align="left"  ><?php echo lang_show('add_nav_name');?></td>
          <td width="317" align="left" ><?php echo lang_show('add_nav_linkaddr');?></td>
          <td width="330" align="left" ><?php echo lang_show('selflag');?></td>
        </tr>
        <tr>
          <td height="24" align="left"  ><input name="menu_name" type="text" id="menu_name" size="20" maxlength="30" value="">          </td>
          <td ><input name="link_addr" type="text" id="link_addr" size="30" maxlength="100" value=""></td>
          <td ><input name="selected_flag" type="text" id="selected_flag" size="10" maxlength="10" value="">
            <input type="hidden" name="addid" id="addid" value="<?php echo $_GET['aid'];?>"></td>
        </tr>
        
        <tr>
          <td colspan="3" align="left" valign="top">
          <input class="btn" type="submit" name="submit" id="submit" value="<?php echo lang_show('add_nav_submit');?>" onClick="return ChkFields()">
          <input class="btn" type="button" name="button" id="button" value="<?php echo lang_show('add_nav_back');?>" onClick="window.location='nav_menu.php'">          </td>
        </tr>
      </table>
	</form>
	</div>
</div>
</body>
</html>