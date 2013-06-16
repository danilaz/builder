<?php
//================================================
if(!empty($_POST['del']))
{
	foreach($_POST['del'] as $key=>$v)
	{
		if(!empty($_POST['del'][$key]))
		{
			$sql="delete from ".SHOWROOM." where id='".$_POST['del'][$key]."'";
			$db->query($sql);
		}
	}
}
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="main.js"></script>
</HEAD>
<body>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('sroom_manager');?></div>
    <div class="bigboxbody">
 <form action="" method="post">
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr >
    <td width="6%"><?php echo lang_show('delete');?></td>
    <td width="25%"><?php echo lang_show('sname');?></td>
	<td width="25%"><?php echo lang_show('saddr');?></td>
    <td width="15%"><?php echo lang_show('spic');?></td>
	 <td width="6%"><?php echo lang_show('isrec');?></td>
    <td width="12%"><?php echo lang_show('act');?></td>
  </tr>
  <?php
  $sql="select * from ".SHOWROOM." order by id desc ";
  $db->query($sql);
  $re=$db->getRows();
  foreach($re as $v)
  {
  ?>
  <tr>
    <td><input type="checkbox" name="del[]" value="<?php echo $v['id'];?>" ></td>
    <td><?php if(!empty($v['show_room_name'])) echo $v['show_room_name'];?></td>
	<td><?php if(!empty($v['show_room_addr'])) echo $v['show_room_addr'];?></td>
    <td><?php if(!empty($v['show_room_pic'])) echo '<img src="'.$v['show_room_pic'].'"><br/>';?></td>
	<td><input type="checkbox" name="is_rec" id="is_rec" value="1" <?php if(!empty($v['is_rec'])&&$v['is_rec']=='1') echo 'checked';?>></td>
    <td><a href="module.php?m=exhibition&s=edit_show_room.php&id=<?php echo $v['id'];?>"><?php echo lang_show('sdet');?></a></td>
  </tr>
  <?php }?>
  <tr>
    <td colspan="2"><input class="btn" type="submit" name="submit" id="button" value="<?php echo lang_show('submit');?>"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
</table>
</form>
</div>
</div>
</body>
</html>