<?php
/**
 *Coupright B2Bbuilder
 *Powered by http://www.b2b-builder.com
 *Auter:Brad zhang
 *Des: company cat
 *Date:2008-11-14
 */
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//=====================================
if(isset($_GET["deid"]))
{
	$sql="delete from ".DOMAIN." WHERE id='$_GET[deid]'";
	$db->query($sql);
}
if(isset($_GET["isopen"]))
{
	$sql="update ".DOMAIN." set isopen=$_GET[isopen] WHERE id='$_GET[id]'";
	$db->query($sql);
}
//=======================================
$sql="select * from ".DOMAIN." where 1 ";
$db->query($sql);
$re=$db->getRows();
//=========================================
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>

<BODY>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('add_type');?></div>
	<div class="bigboxbody"><form method="post" action="" style="margin-top:0px;">
<table width="100%" align="center" cellpadding="0" cellspacing="0" style="line-height:20px; padding:0px;">
  <tr >
    <td width="27%" height="24"  class="hh"><?php echo lang_show('domain');?></td>
    <td width="56%"  class="hh"><?php echo lang_show('con');?></td>
    <td width="17%" align="center"  class="hh"><?php echo lang_show('option');?></td>
  </tr>
  <?php
  foreach($re as $v)
  {
  ?>
  <tr >
    <td height="24"  class="hh"><?php echo $v['isopen']?"<img src='../image/default/on.gif' />":"<img src='../image/default/off.gif' />"; ?>     http://<?php echo $v["domain"].'.'.$config['baseurl']; ?></td>
    <td class="hh"><?php echo $v["con"].",".$v["con2"]; ?><br><?php echo strip_tags($v["des"])?></td>
    <td align="center" >
    <a href="add_sub_domain.php?edit=<?php echo $v["id"]; ?>"><?php echo lang_show('edit');?></a> |
    	<?php if($v["isopen"]==1){?>
	<a href="?isopen=0&id=<?php echo $v["id"]; ?>"><?php echo lang_show('close');?></a>
	<?php }else{?>
	<a href="?isopen=1&id=<?php echo $v["id"]; ?>"><?php echo lang_show('open');?></a>
	<?php } ?> |
	<a href="?deid=<?php echo $v["id"]; ?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');"><?php echo lang_show('delete');?></a>
</td>
  </tr>
  <?php
  }
  ?>
</table>
	</form>
</div>
</div>

</BODY>
</HTML>
