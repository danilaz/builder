<?php
//==================================================
if(!empty($_POST['delsel'])&&$_POST['delsel']==lang_show('delch'))
{
  if(!empty($_POST["checkhr"])&&is_array($_POST["checkhr"]))
	{
		  $deltn=implode(",",$_POST["checkhr"]);
		  $sql="delete from ".HRCAT."  where  id in (".$deltn.")";
		  $db->query($sql);	
		  msg("module.php?m=job&s=hrcat.php");
	      exit();
	}
}
//==================================================
if(!empty($_POST['resort'])&&$_POST['resort']==lang_show('mysort'))
{
    if(is_array($_POST["sort"]))
	{
	   foreach($_POST['sort'] as $key=>$v)
	   {
		  $msql="update ".HRCAT." set posid='".$v."' where id=".$key;
		  $db->query($msql); 
	   }
	}
}
//===========================
if(!empty($_POST["hraction"])&&$_POST["hraction"]==lang_show('modi'))
{		
	$sql="update ".HRCAT." set catname='$_POST[catname]',pid='$_POST[pid]' where id='$_POST[catid]'";
	$db->query($sql);
	msg("module.php?m=job&s=hrcat.php");
	exit();
}
if(!empty($_POST["hraction"])&&$_POST["hraction"]==lang_show('addhr'))
{	
	foreach(explode("\r\n",$_POST['catname']) as $catv)
	{
		$sql="insert into ".HRCAT." (`catname`,`pid`) values ('$catv','$_POST[pid]')";
		$db->query($sql);
	}
	msg("module.php?m=job&s=hrcat.php");
	exit();
}
//=======================
if(!empty($_GET["action"])&&$_GET["action"]=="del"&&!empty($_GET["id"]))
{
	$db->query("delete from ".HRCAT." where id='$_GET[id]'");
}
$sql="select * from ".HRCAT." where pid='0' order by posid";
$db->query($sql);
$hr=$db->getRows();
if(!empty($_GET['id']))
{
	$sql="select * from ".HRCAT." where id='$_GET[id]'";
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
<form name="form2" method="post">
	<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('hrcat');?></div>
	<div class="bigboxbody">
	  <table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
          <td>
            <select name="pid" id="pid">
              <option value="0">Основная категория</option>
			  <?php foreach($hr as $v){ ?>
              <option <?php if(isset($mn)&&$mn['pid']==$v['id']){echo 'selected="selected"';}?> value="<?php echo $v['id'];?>"><?php echo $v['catname'];?></option>
			  <?php } ?>
            </select>
          </td>
        </tr>
        <tr>
          <td width="8%"><?php echo lang_show('catn');?></td>
          <td width="92%">
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
	      echo lang_show('modi');
	   else
        echo lang_show('addhr');
	  ?>"></td>
        </tr>
      </table>
	</div>
</div>
</form>
<div style="float:left; height:50px; width:50%;">&nbsp;</div>
<form action="" method="post">
	<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('hrcat');?></div>
	<div class="bigboxbody">

	  <table width="100%" border="0">
        <tr>
          <td width="20" ><input type="checkbox" name="checkbox" id="checkbox" onClick="checkall()"></td>
		  <td width="112" ><?php echo lang_show('snum');?></td>
          <td width="628" ><?php echo lang_show('catn');?></td>
          <td width="137" ><?php echo lang_show('actit');?></td>
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
		    $sql="select * from ".HRCAT." where pid='$v[id]' order by posid";
			$db->query($sql);
			$shr=$db->getRows();
			foreach($shr as $sv){
		  ?>
		  <input type="checkbox" name="checkhr[]" value="<?php echo $sv['id'];?>">
		  <?php echo $sv['catname'];?>
		  [<a href="module.php?m=job&s=hrcat.php&action=modify&id=<?php echo $sv['id'];?>"> <?php echo lang_show('modi');?></a>|
		  <a href="module.php?m=job&s=hrcat.php&action=del&id=<?php echo $sv['id'];?>"> <?php echo lang_show('delit');?></a>]
		  <br>
		  <?php } ?>
		  </td>
          <td valign="top">
		  <a href="module.php?m=job&s=hrcat.php&action=modify&id=<?php echo $v['id'];?>"> <?php echo lang_show('modi');?></a>|
		  <a href="module.php?m=job&s=hrcat.php&action=del&id=<?php echo $v['id'];?>"> <?php echo lang_show('delit');?></a>
		  </td>
        </tr>
		<?php
		  }
			?>
			<tr>
          <td colspan="4" align="left" ><input class="btn" type="submit" name="delsel" id="delsel" value="<?php echo lang_show('delch');?>">
          <input class="btn" type="submit" name="resort" id="resort" value="<?php echo lang_show('mysort');?>"></td>
        </tr>
      </table>
 </div>
 </div>
</form>
</body>
</html>

