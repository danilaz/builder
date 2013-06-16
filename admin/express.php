<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
@include_once("../lang/" . $config['language'] . "/admin/global.php");
@include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//================================================
if(!empty($_POST['renew']))
{
	foreach($_POST['comname'] as $key=>$v)
	{
		if(!empty($_POST['del'][$key]))
		{
			$deid=$_POST['del'][$key];
			$sql="delete from ".EXPRESS." where id='$deid'";
			$db->query($sql);
		}
		else
		{
			if(!empty($_POST['exid'][$key]))
				$sql="update ".EXPRESS." set company_name='$v',inquire_url='".$_POST['urladdr'][$key]."' where
				id='".$_POST['exid'][$key]."'";
			elseif(!empty($v))
				$sql="insert into ".EXPRESS." 
				(company_name,inquire_url) values 
				('$v','".$_POST['urladdr'][$key]."')";
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
	<div class="bigboxhead"><?php echo lang_show('exp_m');?></div>
    <div class="bigboxbody">
 <form action="" method="post">
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr >
    <td width="11%"><?php echo lang_show('delit');?></td>
    <td width="30%"><?php echo lang_show('cname');?></td>
    <td colspan="2"><?php echo lang_show('inq_url');?></td>
    </tr>
  <?php
  $sql="select * from ".EXPRESS;
  $db->query($sql);
  $re=$db->getRows();
  foreach($re as $v)
  {
  ?>
  <tr>
    <td><input type="checkbox" name="del[]" value="<?php echo $v['id'];?>" ></td>
    <td><input name="comname[]" type="text" value="<?php echo $v['company_name'];?>" size="30" maxlength="30" ></td>
    <td width="41%"><input name="urladdr[]" type="text" value="<?php echo $v['inquire_url'];?>" size="50" maxlength="60" ></td>
    <td width="18%"><input type="hidden" name="exid[]" value="<?php echo $v['id'];?>"></td>
  </tr>
  <?php }?>
  <tr>
    <td><?php echo lang_show('add_new');?></td>
    <td><input name="comname[]" type="text" size="30" maxlength="30" ></td>
    <td><input name="urladdr[]" type="text" size="50" maxlength="60" ></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><input class="btn" type="submit" name="renew" id="renew" value="<?php echo lang_show('submit');?>"></td>
  </tr>
</table>
</form>
</div>
</div>
</body>
</html>