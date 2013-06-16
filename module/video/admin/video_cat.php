<?php
//==================================================
if(!empty($_POST['delsel'])&&$_POST['delsel']=="Удалить")
{
  if(!empty($_POST["checkhr"])&&is_array($_POST["checkhr"]))
	{
		  $deltn=implode(",",$_POST["checkhr"]);
		  $sql="delete from ".VCAT."  where  id in (".$deltn.")";
		  $db->query($sql);	
		  msg("module.php?m=video&s=video_cat.php");
	      exit();
	}
}
//==================================================
if(!empty($_POST["hraction"])&&$_POST["hraction"]=="Изменить")
{		
	$sql="update ".VCAT." set catname='$_POST[catname]' where id='$_POST[catid]'";
	$db->query($sql);
	msg("module.php?m=video&s=video_cat.php");
	exit();
}
if(!empty($_POST["hraction"])&&$_POST["hraction"]=="Добавить")
{	
	foreach(explode("\r\n",$_POST['catname']) as $catv)
	{
	  
		$sql="insert into ".VCAT." (`catname`,`pid`) values ('$catv','$_POST[pid]')";
		$db->query($sql);
	}
	msg("module.php?m=video&s=video_cat.php");
	exit();
}
//=======================
if(!empty($_GET["action"])&&$_GET["action"]=="del"&&!empty($_GET["id"]))
{
	$db->query("delete from ".VCAT." where id='$_GET[id]'");
}
$sql="select * from ".VCAT." where pid=0 order by posid";
$db->query($sql);
$hr=$db->getRows();
if(!empty($_GET['id']))
{
	$sql="select * from ".VCAT." where id='$_GET[id]'";
	$db->query($sql);
	$mn=$db->fetchRow();
}
//=======================
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<script type="text/javascript">
function checkall()
{
	 for(var j = 0 ; j < document.getElementsByName("checkhr[]").length; j++)
	 {
	  	if(document.getElementsByName("checkhr[]")[j].checked==true)
	  	  document.getElementsByName("checkhr[]")[j].checked = false;
		else
		  document.getElementsByName("checkhr[]")[j].checked = true;
	 }
}
</script>
<form name="form2" method="post" action="">
	<div class="bigbox">
	<div class="bigboxhead">Управление категориями видео</div>
	<div class="bigboxbody">
	  <table width="100%" border="0" cellspacing="1" cellpadding="0">
	  <tr>
	  	<td width="10%"></td>
		<td width="90%">
		<select name="pid">
		<option value="0">Основная категория</option>
		<?php foreach($hr as $key=>$v){ ?>
		<option  value="<?php echo $v['id'] ?>"><?php echo $v['catname'] ?></option>
		<?php }?>
		</select>
		</td>
	  </tr>
        <tr>
          <td width="10%">Название</td>
          <td width="90%">
			 <textarea name="catname" cols="30" rows="6" id="catnmae"><?php 
			 if(!empty($_GET["action"])&&$_GET["action"]=="modify"&&!empty($_GET["id"]))
			  {
				echo $mn['catname'];
			  }
			 ?></textarea>
		  </td>
        </tr>
        <tr>
          <td><input type="hidden" name="catid" value="<?php if (!empty($_GET["id"])) echo $_GET["id"];?>">&nbsp;</td>
          <td><input class="btn" type="submit" name="hraction" value="<?php 
	  if(!empty($_GET["action"])&&$_GET["action"]=="modify")
	      echo "Изменить";
	   else
        echo "Добавить";
	  ?>"></td>
        </tr>
      </table>
	</div>
</div>
</form>
<div style="float:left; height:50px; width:50%;">&nbsp;</div>
<form action="" method="post">
	<div class="bigbox">
	<div class="bigboxhead">Управление категориями видео</div>
	<div class="bigboxbody">

	  <table width="100%" border="0">
        <tr>
          <td width="60" ><input type="checkbox" name="checkbox" id="checkbox" onClick="checkall()">Выбрать</td>
		  <td width="90">Порядок</td>
          <td width="376" >Название</td>
          <td width="479" >Действие</td>
        </tr>
        <?php
	      foreach ($hr as $v)
          {
        ?>
        <tr>
          <td valign="top"><input type="checkbox" name="checkhr[]" value="<?php echo $v['id'];?>"></td>
		  <td valign="top"><input name="sort[<?php echo $v['id'];?>]" id="sort[<?php echo $v['id'];?>]" type="text" value="<?php echo $v['posid'];?>" size="5" maxlength="3"></td>
          <td >
		  <b><?php echo $v['catname'];?></b><br>
		   <?php
		     $sql="select * from ".VCAT." where pid='$v[id]' order by posid";
		      $db->query($sql);
			   $res=$db->getRows();
		     foreach($res as $key=>$v)
			 {  ?>
			    <input type="checkbox" name="checkhr[]" value="<?php echo $v['id'];?>">
			 <?php  echo $v['catname'];?>
		[<a href="module.php?m=video&s=video_cat.php&action=modify&id=<?php echo $v['id'];?>">Изменить</a>|
		  <a href="module.php?m=video&s=video_cat.php&action=del&id=<?php echo $v['id'];?>">Удалить</a>]
		  <br/>
		   <?php
			 }
		   ?>
		  </td>
          <td width="479" valign="top">
		  <a href="module.php?m=video&s=video_cat.php&action=modify&id=<?php echo $v['id'];?>">Изменить</a>|
		  <a href="module.php?m=video&s=video_cat.php&action=del&id=<?php echo $v['id'];?>">Удалить</a>		  </td>
        </tr>
		<?php
		  }
			?>
			<tr>
          <td colspan="4" align="left" ><input class="btn" type="submit" name="delsel" id="delsel" value="Удалить"></td>
        </tr>
      </table>
 </div>
 </div>
</form>
</body>
</html>