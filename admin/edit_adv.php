<?php
header("Cache-Control: no-store, no-cache, must-revalidate");  // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//=============================================
$submit=isset($_POST['submit'])?$_POST['submit']:NULL;
if($submit==lang_show('delete')&&isset($_GET["id"]))
{
	$db->query("delete from ".ADVS." where ID='$_GET[id]'");
	$db->query("delete from ".ADVSCON." where group_id='$_GET[id]'");
	msg('advs.php');
}
if($submit==lang_show('submit')&&isset($_GET["id"]))
{	
	$date=date("Y-m-d H:i:s");
	$sql="UPDATE ".ADVS." SET con='$_POST[con]',name='$_POST[name]',ad_type='$_POST[ad_type]',width='$_POST[width]',height='$_POST[height]',date='$date',price='$_POST[price]' WHERE ID=$_GET[id]";
	$re=$db->query($sql);
	if($re==true)
		msg("advs.php");
}
elseif($submit&&!isset($_GET["id"]))
{
	$date=date("Y-m-d H:i:s");
	$sql="insert into ".ADVS." (con,ad_type,name,date,width,height,price)
	      values
	      ('$_POST[con]','$_POST[ad_type]','$_POST[name]','$date','$_POST[width]','$_POST[height]','$_POST[price]')";
	if($db->query($sql)==true)
		msg("advs.php");
}
//============================================
if(isset($_GET["id"]))
{
	$sql="SELECT * FROM ".ADVS." WHERE ID=$_GET[id]";
	$db->query($sql);
	$de=$db->fetchRow();
}
else
	$de=NULL;
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<form action="" method="post" enctype="multipart/form-data" name="form1">
<div class="bigbox">
	<div class="bigboxhead">
	<span style="float:left"><?php  if(isset($_GET["id"]))echo lang_show('medit');else echo lang_show('advsadd');?><?php echo lang_show('advplace');?></span>
	</div>
	<div class="bigboxbody"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <?php
  if(isset($_GET["id"]))
  {
  ?>
  <tr>
    <td><?php echo lang_show('advplnum');?></td>
    <td><?php echo $_GET["id"];?></td>
  </tr>
  <?php } ?>
  <tr>
    <td><?php echo lang_show('adv_l_type');?> <a href="http://help.b2b-builder.com/2-5.html" target="_blank"><img src="../image/admin/Help Circle.jpg" border="0"></a></td>
    <td>
      <select name="ad_type" id="ad_type">
        <option value="1" <?php if(!empty($de['ad_type'])&&$de['ad_type']==1) echo "selected";?>><?php echo lang_show('gen_adv');?></option>
        <option value="2" <?php if(!empty($de['ad_type'])&&$de['ad_type']==2) echo "selected";?>><?php echo lang_show('flash_adv');?></option>
        <option value="3" <?php if(!empty($de['ad_type'])&&$de['ad_type']==3) echo "selected";?>><?php echo lang_show('duilian_adv');?></option>
      </select>
    </td>
  </tr>
  <tr>
    <td><?php echo lang_show('wh');?></td>
    <td>
      <input name="width" type="text" id="width" size="5" value="<?php if(!empty($de["width"]))echo $de["width"];?>">
      <input name="height" type="text" id="height" size="5" value="<?php if(!empty($de["height"]))echo $de["height"];?>">
   </td>
  </tr>
  <tr>
    <td width="200"><?php echo lang_show('advplname');?></td>
    <td width="800"><input type="text" name="name" style="width:200px;" value="<?php echo $de["name"];?>"/></td>
    </tr>
 <tr>
    <td width="200"><?php echo lang_show('advprice');?></td>
    <td width="800"><input type="text" name="price" style="width:200px;" value="<?php echo $de["price"];?>"/></td>
    </tr>
  <tr>
    <td><?php echo lang_show('advpldes');?></td>
    <td><textarea name="con" cols="80" rows="10" id="con"><?php echo $de["con"];?></textarea></td>
    </tr>
<?php if(isset($_GET["id"])){?>
  <tr>
    <td><?php echo lang_show('use_code');?>:</td>
    <td><label>
      <input name="js" type="text" id="js" value="<script src='&lt;{$config.weburl}&gt;/api/ad.php?id=<?php echo $de["ID"]; ?>&catid=&lt;{$smarty.get.id}&gt;&sname=&lt;{$sname}&gt;'></script>" size="70">
    </label></td>
  </tr>
<?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td>
    <input class="btn" type="submit" name="submit" value="<?php echo lang_show('submit');?>" />
    <input class="btn" type="submit" name="submit" value="<?php echo lang_show('delete');?>" />
    </td>
  </tr>
</table>
  </div>
</div>
</form>
</body>
</html>