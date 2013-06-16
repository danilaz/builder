<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//=================
if(!empty($_POST["delid"]))
{
	$id=implode(",",$_POST["delid"]);
	$sql="delete from ".CTYPE." WHERE id in ($id)";
	$db->query($sql);
	msg("comments_list.php");
}
?>
<HTML>
<head>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../lib/lightbox.css" media="screen,projection" type="text/css" />
<script type="text/javascript" src="../script/prototype.js"></script>
<script type="text/javascript" src="../script/lightbox.js"></script>
</head>
<body>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('optinmang');?></div>
	<div class="bigboxbody">
	<form action="" method="post" style="margin-top:0px;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php
	include_once("../lang/" . $config['language'] . "/company_type_config.php");
	foreach($companyType as $v)
	{
	?>
  	<tr>
    	<td colspan="3" bgcolor="#CCCCCC"><strong><?php echo $v?></strong> <a class="lbOn" href="comments.php?ctype=<?php echo urlencode($v)?>"><?php echo lang_show('addoption');?></a></td>
    </tr>
	<?php
	$sql="select * from ".CTYPE." where company_type='$v'";
	$db->query($sql);
	$re=$db->getRows();
	foreach($re as $v)
	{
	?>
  	<tr>
    <td width="4%">&nbsp;</td>
    <td width="6%"><input type="checkbox" name="delid[]" value="<?php echo $v["id"]; ?>"></td>
    <td width="90%"><?php echo $v["name"]; ?> <a class="lbOn" href="comments.php?id=<?php echo $v["id"]; ?>&sub=true"><?php echo lang_show('adds');?></a> | <a class="lbOn" href="comments.php?id=<?php echo $v["id"]; ?>&name=<?php echo urlencode($v["name"])?>&con=<?php echo urlencode($v["con"])?>&edit=true"><?php echo lang_show('edits');?></a><br><span >[<?php echo $v["con"]; ?>]</span></td>
  </tr>
   <?php
   $sid=$v["id"]."00";
   $bid=$v["id"]."99";
   $sql="select * from ".CTYPE." where id>='$sid' and id<='$bid'";
   $db->query($sql);
   $sre=$db->getRows();
   foreach($sre as $sv)
   {
   ?>
   <tr>
    <td>&nbsp;</td>
    <td width="6%"><input type="checkbox" name="delid[]" value="<?php echo $sv["id"]; ?>"></td>
    <td width="90%" style="padding-left:30px;"><?php echo $sv["name"]; ?> <a class="lbOn" href="comments.php?id=<?php echo $sv["id"]; ?>&name=<?php echo urlencode($sv["name"])?>&con=<?php echo urlencode($sv["con"])?>&edit=true"><?php echo lang_show('edits');?></a><br><span >[<?php echo $sv["con"]; ?>]</span></td>
  </tr>
  <?php }}} ?>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" align="left"><input class="btn" type="submit" name="submit" value="<?php echo lang_show('delete');?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');"></td>
    </tr>
</table>
	</form>
	</div>
</div>

 
</body>
</HTML>