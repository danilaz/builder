<?php
if(!empty($_GET['deid']))
{
	$sql="delete from ".BRAND." where id='$deid'";
	$re=$db->query($sql);
}

function update_custom_cat()
{
	global $db,$config;
	foreach($_POST['cid'] as $key=>$v)
	{
		if(!empty($_POST['del'][$key]))// is select del,will delete the item
		{
			$deid=$_POST['del'][$key];
			$sql="delete from ".BRAND." where id='$deid'";
			$re=$db->query($sql);
		}
		else
		{
			$_POST['nums'][$key]=empty($_POST['nums'][$key])?1:$_POST['nums'][$key];
			$_POST['statu'][$key]=empty($_POST['statu'][$key])?1:$_POST['statu'][$key];
			if(!empty($_POST['cid'][$key]))
			{
				$sql="update ".BRAND." set nums='".$_POST['nums'][$key]."',
				statu='".$_POST['statu'][$key]."' 
				where id='".$_POST['cid'][$key]."'";//update
				$ssql=NULL;
			}
			$db->query($sql);
		}
	}
}
if(!empty($_POST['submit']))
{
	update_custom_cat();
	admin_msg('module.php?m=brand&s=brand_list.php','Успешно выполнено!');
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
	<div class="bigboxhead"><?php echo lang_show('brand');?></div>
    <div class="bigboxbody">
 <form action="" method="post" enctype="multipart/form-data">
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr >
    <td width="44"><?php echo lang_show('delete');?></td>
    <td width="39"><?php echo lang_show('nums');?></td>
    <td width="33">Показ|реком</td>
    <td width="155">Лого</td>
    <td width="152"><?php echo lang_show('name');?></td>
    <td width="201"><?php echo lang_show('company');?></td>
    <td width="173"><?php echo lang_show('tel');?></td>
    <td width="138">Действие</td>
  </tr>
  <?php
  $i=0;
  $sql="select * from ".BRAND." order by nums asc ";
  $db->query($sql);
  $re=$db->getRows();
  foreach($re as $v)
  {
  ?>
  <tr >
    <td>
	<input type="hidden" name="cid[]" value="<?php echo $v['id'];?>">
	<input type="checkbox" name="del[]" value="<?php echo $v['id'];?>" ></td>
    <td><input name="nums[]" type="text" maxlength="4" size="4" value="<?php echo $v['nums'];?>"></td>
     <td><input type="checkbox" name="statu[<?php echo $i;?>]" value="2" <?php if($v['statu']==2) echo 'checked';?> ></td>
    <td>
	<?php 
		if(!empty($v["pic"])) 
			echo '<img src="'.$v["pic"].'" >';
    ?></td>
    <td><?php echo $v['name'];?></td>
    <td><?php echo $v['company'];?></td>
    <td><?php echo $v['tel'];?></td>
    <td>
	<a href="module.php?m=brand&s=add_brand.php&id=<?php echo $v['id'];?>"><?php echo $editimg;?></a>
	<a href="module.php?m=brand&s=brand_list.php&deid=<?php echo $v['id'];?>"><?php echo $delimg;?></a>
	</td>
  </tr>
  <?php $i++; }?>
  <tr>
    <td colspan="8"><input class="btn" type="submit" name="submit" id="button" value="<?php echo lang_show('submit');?>"></td>
    </tr>
</table>
</form>
</div>
</div>
</body>
</html>