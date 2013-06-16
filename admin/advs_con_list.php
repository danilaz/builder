<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//===============================================
if(isset($_GET['deid']))
{
	$db->query("delete from ".ADVSCON." where ID='$_GET[deid]'");
}
$db->query("select * from ".ADVS." where id='$_GET[group_id]'");
$group_detail=$db->fetchRow();
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8"> 
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<div class="bigbox">
	<div class="bigboxhead">
		<?php echo lang_show('adv_menager').'-'.$group_detail['name'];?>
	</div>
	<div class="bigboxbody">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr> 
      <td width="17%" align="left"><?php echo lang_show('name');?> </td>
      <td width="9%" align="left"><?php echo lang_show('type');?></td>
      <td width="10%" align="left"><?php echo lang_show('area');?></td>
      <td width="11%" align="left">Категория</td>
      <td width="17%" align="left">Файл</td>
      <td width="16%" align="left"><?php echo lang_show('start_or_end_time');?></td>
      <td width="9%" align="left">Показы</td>
      <td width="11%" align="center"><?php echo lang_show('operate');?></td>
    </tr>
    <?php
	$adt[1]=lang_show('text');
	$adt[2]=lang_show('code');
	$adt[3]=lang_show('image');
	$adt[4]=lang_show('flash');
	$tsql=NULL;
	if(!empty($_SESSION['province']))
		$tsql=" and province='$_SESSION[province]'";
	if(!empty($_SESSION['city']))
		$tsql=" and city='$_SESSION[city]'";
	$db->query("select * from ".ADVSCON." where group_id='$_GET[group_id]' $tsql order by ID desc");
	$re=$db->getRows();
	for($i=0;$i<count($re);$i++)
	{ 
	?>
    <form name="form1" method="post" action="">
      <tr> 
        <td align="left">
		<?php echo $re[$i]['isopen']?"<img src='../image/default/on.gif' />":"<img src='../image/default/off.gif' />";?>
		<?php echo $re[$i]['name'];?>&nbsp;</td>
        <td align="left"><?php $t=$re[$i]['type'];echo $adt[$t];?></td>
        <td align="left"><?php if($re[$i]['province']||$re[$i]['city']) echo $re[$i]['province'].$re[$i]['city'];else echo lang_show('ishome'); ?></td>
        <td align="left"><?php echo $re[$i]['catid'];?> &nbsp;</td>
        <td align="left"><?php echo $re[$i]['sname'];?> &nbsp;</td>
        <td align="left"><?php echo $re[$i]['stime']; ?>/<?php echo $re[$i]['etime']; ?></td>
        <td align="left"><?php echo $re[$i]['shownum'];?>&nbsp;</td>
        <td align="center">
		<a href="edit_adv_con.php?id=<?php echo $re[$i]['ID'];?>&type=<?php echo $re[$i]['type']; ?>&group_id=<?php echo $re[$i]['group_id']; ?>"><?php echo $editimg;?></a>
		<a href="?deid=<?php echo $re[$i]['ID'];?>&group_id=<?php echo $_GET['group_id'];?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');">
		<?php echo $delimg;?>
		</a>
		</td>
      </tr>
    </form>
    <?php 
	 }
	?>
	<tr>
	<td colspan="8">
	<b>
	<a href="edit_adv_con.php?type=1&group_id=<?php echo $_GET['group_id']; ?>">+<?php echo lang_show('addadvs');?></a>&nbsp;&nbsp;
	<a href="advs.php">&lt;&lt; Вернуться к списку</a>
	</b>
	</td>
	</tr>
  </table>
  </div>
</div>
</body>
</html>
