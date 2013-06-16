<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//=================================================
if(!empty($_GET['action']))
{
	if($_GET['action']=='r')
		$db->query("REPAIR TABLE $_GET[name]");
	else
		$db->query("OPTIMIZE TABLE  $_GET[name]");
	admin_msg("optimizetable.php","Успешно выполнено!");
}
if(!empty($_POST['submit'])==lang_show('repact'))
{
	foreach($_POST['optables'] as $v)
	{
		$sql="REPAIR TABLE  $v";
		$db->query($sql);
	}
	admin_msg("optimizetable.php","Успешно выполнено!");
}
if(!empty($_POST['submit'])==lang_show('optact'))
{
	foreach($_POST['optables'] as $v)
	{
		$sql="OPTIMIZE TABLE  $v";
		$db->query($sql);
	}
	admin_msg("optimizetable.php","Успешно выполнено!");
}
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('tableoprep');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<script type="text/javascript">
function checkall()
{
	 for(var j = 0 ; j < document.getElementsByName("optables[]").length; j++)
	 {
	  	if(document.getElementsByName("optables[]")[j].checked==true)
	  	  document.getElementsByName("optables[]")[j].checked = false;
		else
		  document.getElementsByName("optables[]")[j].checked = true;
	 }
}
</script>
<form name="form1" method="post" action="">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('tableoprep');?></div>
	<div class="bigboxbody">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
    <tr>
      <td height="16" colspan="7" align="left"><p ><?php echo lang_show('repairmsg');?></p>
        <p ><?php echo lang_show('optimizemsg');?></p>        </td>
      </tr>
      <tr>
        <td width="3%" height="16" align="right" ><input name="checktagall" type="checkbox" class="STYLE1" id="checktagall" onClick="checkall()"></td>
        <td width="23%" align="left" ><strong><?php echo lang_show('tname');?></strong></td>
        <td width="20%" align="left" ><strong>Кодировка</strong></td>
        <td width="14%" align="left" ><strong>Система</strong></td>
        <td width="12%" align="left" ><strong>Записи</strong></td>
        <td width="15%" align="left" ><strong>Размер(Kб)</strong></td>
        <td width="13%" align="left" ><strong>Действие</strong></td>
      </tr>
	  <?php 
	  $db->query("SHOW TABLE STATUS FROM ".$config['dbname']);
	  $re=$db->getRows();
	  foreach($re as $v)
	  {
		  if(substr($v['Name'],0,3)==substr($config['table_pre'],0,3))
		  {
	  ?>
      <tr>
      <td height="16" align="right"  ><input name="optables[]" type="checkbox" value="<?php echo $v;?>"></td>
	  <td align="left"  ><?php echo $v['Name'];?> </td>
      <td align="left"  ><?php echo $v['Collation'];?></td>
      <td align="left"  ><?php echo $v['Engine'];?></td>
      <td align="left"  ><?php echo $v['Rows'];?></td>
      <td align="left"  ><?php echo round($v['Data_length']/1024, 2);?></td>
      <td align="left"  ><a href="?action=r&name=<?php echo $v['Name'];?>">Ремонт</a> | <a href="?action=o&name=<?php echo $v['Name'];?>">Оптимизация</a></td>
      </tr>
    <?php }} ?>
    <tr>
      <td height="20" colspan="7" align="left">
          <input name="submit" class="btn" type="submit" value="<?php echo lang_show('repact');?>">
          <input name="submit" class="btn" type="submit" value="<?php echo lang_show('optact');?>"></td>
      </tr>
  </table>
  </div>
</div>
</form>
</div>
</div>
</body>
</html>