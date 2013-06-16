<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/web_con_type.php");
include_once("auth.php");
//===========================================	
if(isset($_POST['submit']))
{	
	if ($_POST['submit']=='add'&&!empty($_POST['title']))
	{
		$msql="insert into ".WEBCONGROUP." (title,lang) values ('".addslashes($_POST['title'])."','$config[language]')";
		$db->query($msql); 
	}
}
if(isset($_POST['editID'])&&!empty($_POST['title']))
{	
	$msql="update ".WEBCONGROUP." set title='".addslashes($_POST['title'])."' where id=$_POST[editID]";
	$db->query($msql); 
	admin_msg("web_con_group.php",'操作成功');
}

if(isset($_GET['action']))
{
	if($_GET['action']=='del'&&isset($_GET['did']))
	{
		$sql="delete from ".WEBCONGROUP." where id='$_GET[did]'";
		$db->query($sql); 
		$sql ="update ".WEBCON." set con_group='' where con_group='$_GET[did]'";
		$db->query($sql);
	}
}
//============================================
if(isset($_GET['edit_id']))
{
	$sql = "select * from ".WEBCONGROUP." where lang='$config[language]' and id='$_GET[edit_id]'";
	$db->query($sql);
	$de=$db->fetchRow();
}
else
{
	$sql="select * from ".WEBCONGROUP." where lang='$config[language]'";
	$db->query($sql);
	$de=$db->getRows();
}
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<body>
<link href="main.css" rel="stylesheet" type="text/css" />
<div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('about_us');?></div>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('web_con_type');?></div>
<div class="bigboxbody">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
	  <td colspan="8">
		<a href="web_con_type.php">Вернуться>></a>
	  </td>
	</tr>
<?php
	if(isset($_GET['edit_id'])){
?>
<tr>
<td>
<fieldset style='border:1px dashed #CCCCCC;width:400px;margin-left:30px;padding-bottom:30px;'>
<legend style='margin-left:25px;'>&nbsp;Редактировать&nbsp;</legend>
<form action='' method='post'>
	<table>
		<tr>
			<td style='border:none;'>Название: </td><td style='border:none;'><input type='text' name='title' size=40 value="<?php echo $de['title']; ?>" /></td>
		</tr><tr>
			<td style='border:none;'></td><td style='border:none;'><input type='submit' value="<?php echo lang_show('submit'); ?>" /> 
<input type='hidden' name='editID' value='<?php echo $de['id']; ?>' /></td>
		</tr>
	</table>
</form>
</fieldset>
</td>
</tr>
<?php }else{ ?>
 <tr><td>
<form method="post" action="" onSubmit="return document.getElementById('title').value!='';">
Добавить группу&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' id='title' size="40" name='title' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value="<?php echo lang_show('submit'); ?>" /> 
<input type='hidden' name='submit' value='add' />
</form>
</td>
</tr>
<tr>
<td style='padding:0;border-top:none;'>
<form method="" action="">
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr><td>Название</td><td>Действие</td></tr>
 <?php foreach($de as $v){ ?>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;<?php echo $v['title']; ?></td>
	<td>
	<a href="web_con_group.php?edit_id=<?php echo $v['id']; ?>"><img title="<?php echo lang_show('conset');?>" src="../image/admin/edit.gif"></a>
          <a href="web_con_group.php?action=del&did=<?php echo $v['id']; ?>" onClick="javascript:return confirm('Вы действительно хотите удалить?')"><img title="<?php echo lang_show('delete'); ?>" src="../image/admin/del.gif"></a>
	</td>
  </tr>
  <?php } ?>
  <!--<tr>
    <td colspan=2><input class="btn" type="submit" name="cc" value="<?php echo lang_show('submit');?>"></td>
  </tr>-->
 <tr>
    <td height='40px' colspan=2>&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
<?php } ?>
<table>

</div>
</div>
</body>
</html>
