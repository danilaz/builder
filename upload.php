<?php 
include_once("includes/global.php");
//==============================================
if(is_uploaded_file($_FILES['pic']['tmp_name']))
{
	$pn=time().".jpg";
	$pw=$_POST['pw'];
	$ph=$_POST['ph'];
	
	$dir=$config['webroot'].'/uploadfile/all/'.date('Y').'/'.date('m').'/'.date('d').'/'; 
	mkdirs($dir);
	makethumb($_FILES['pic']['tmp_name'],$dir.$pn,$pw,$ph);
	$pn=str_replace($config['webroot'],$config['weburl'],$dir).$pn;
	
	$str="window.parent.document.getElementById('$_GET[obj]').value='$pn';";
	echo "<script>$str;window.parent.close_win();</script>";
	die;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Загрузка изображения</title>
</head>
<style>
td{font-size:12px; padding:3px;}
</style>
<body>
<?php if(empty($_GET['pv'])){ ?>
<form action="" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><input name="pic" type="file" id="pic" /></td>
  </tr>
  <tr>
    <td>
	  Ширина <input name="pw" type="text" id="pw" value="<?php echo $_GET['pw'];?>" size="3" />
	  px 
	  Высота <input name="ph" type="text" id="ph" value="<?php echo $_GET['ph'];?>" size="3" />
	  px
	  </td>
  </tr>
  <tr>
    <td>
      <input type="submit" name="Submit" value="Отправить" />
      <input type="reset" onclick="window.parent.close_win();" name="Submit2" value="Отменить" />
    </td>
  </tr>
</table>
</form>
<?php
}
else
{
?>
<div id="preview" style="width:380px; height:300px; overflow:auto;"></div>
<script>
str=window.parent.document.getElementById('<?php echo $_GET['obj'];?>').value;
if(str=='')
	str='<font face="arial,tahoma" size=2>Адрес изображения отсутствует, не удается выполнить предварительный просмотр!</font>';
else
	str='<img src='+str+'>';
document.getElementById('preview').innerHTML=str;
</script>
<?php } ?>
</body>
</html>
