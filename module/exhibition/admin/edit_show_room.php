<?php
//================================================
if(!empty($_POST['eshow']))
{
	if(empty($_POST['is_rec']))
		$rec='0';
	else
		$rec='1';
	if(!empty($_POST['sid']))
	{		
		$sql="update ".SHOWROOM." set show_room_name='".$_POST['show_name']."',show_room_intro='".$_POST['des'].
		"',show_room_addr='".$_POST['show_addr']."',is_rec='".$rec."',show_room_pic='$_POST[show_room_pic]' where id='".$_POST['sid']."'";
		$db->query($sql);
	}
	else
	{
		$sql="insert into ".SHOWROOM." (show_room_name,show_room_intro,show_room_addr,is_rec,show_room_pic) values 
		('$_POST[show_name]','$_POST[des]','$_POST[show_addr]','$rec','$_POST[show_room_pic]')";
		$db->query($sql);
		$shid=$db->lastid();
	}
	msg('module.php?m=exhibition&s=show_room.php');
}
if(!empty($_GET['id']))
{
	$sql="select * from ".SHOWROOM." where id='".$_GET['id']."'";
	$db->query($sql);
	$re=$db->fetchRow();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo lang_show('admin_system');?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="main.js"></script>
<script>
closeimg='<?php echo $config['weburl'];?>/image/default/icon_close.gif';
weburl='<?php echo $config['weburl'];?>';
</script>
<script src="../script/my_lightbox.js" language="javascript"></script>
<script type="text/javascript" src="../script/prototype.js"></script>
</head>
<body>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('sroom_manager');?></div>
    <div class="bigboxbody">
 <form action="" method="post" enctype="multipart/form-data">
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="11%" height="31"><?php echo lang_show('sname');?></td>
    <td width="89%"><input type="text" name="show_name" id="show_name" size="50" value="<?php if(!empty($re['show_room_name'])) echo $re['show_room_name'];?>"></td>
	</tr>
  <tr>
    <td height="36"><?php echo lang_show('saddr');?></td>
    <td><input type="text" name="show_addr" id="show_addr" size="50" value="<?php if(!empty($re['show_room_addr'])) echo $re['show_room_addr'];?>"></td>
  </tr>
  <tr>
    <td height="38"><?php echo lang_show('sintro');?></td>
    <td><textarea name="des" id="des" cols="80" rows="15"><?php if(!empty($re['show_room_intro'])) echo $re['show_room_intro'];?></textarea></td>
  </tr>
  <tr>
    <td height="28"><?php echo lang_show('spic');?></td>
    <td><input name="show_room_pic" type="text" id="show_room_pic" value="<?php echo $re['show_room_pic'];?>" size="70">
		 [<a href="javascript:uploadfile('Загрузить логотип','show_room_pic',100,100)">Загрузить</a>] 
		 [<a href="javascript:preview('show_room_pic');">Предпросмотр</a>]
		 [<a onclick="javascript:$('show_room_pic').value='';" href="#">Удалить</a>]
	</td>
  </tr>
    <tr>
    <td height="31"><?php echo lang_show('isrec');?></td>
    <td><input type="checkbox" name="is_rec" id="is_rec"  value="1" <?php if(!empty($re['is_rec'])&&$re['is_rec']=='1') echo 'checked';?>></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input class="btn" type="submit" name="eshow" id="eshow" value="<?php echo lang_show('submit');?>"><input type="hidden" name="sid" id="sid" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>"></td>
    </tr>
</table>
</form>
</div>
</div>
</body>
</html>