<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//==========================================
if(isset($_GET['step']) && $_GET['step']=='unset')
{
	$sql = "update ".PAYMENT." set active='0' where payment_type='$_GET[payment_type]'";
	$db->query($sql);
}
function load_modules($modules_dir = '')
{
	if(!$modules_dir) {
		return false;
	}
	$target_dir = @opendir($modules_dir);
	$modules_loading = true;
	$modules_list = array();

	while(($module = @readdir($target_dir)) !== false) {
		if (preg_match("/^.*?\.php$/", $module)) {
			include_once($modules_dir.'/'.$module);
		}
	}
	@closedir($target_dir);
	return $modules_list;
}
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/prototype.js"></script>
<script type="text/javascript" src="main.js"></script>
</HEAD>
<body>
  <form action="" method="get">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('payment_set');?></div>
	<div class="bigboxbody">
	  <table width="100%" border="0" cellpadding="2" cellspacing="0" >
        <tr >
          <td width="10%" ><?php echo lang_show('payment_h');?></td>
          <td ><?php echo lang_show('payment_b');?></td>
          <td width="8%" align="center" ><?php echo lang_show('payment_c');?></td>
          <td width="15%" align="center" ><?php echo lang_show('payment_d');?></td>
          <td width="10%" align="center" ><?php echo lang_show('payment_e');?></td>
        </tr>
        <?php
	$payments = load_modules('payment');
	$coun_num = count($payments);
	for($i=0;$i<$coun_num;$i++)
	{
		include_once("../lang/" . $config['language'] . "/payment/".$payments[$i]['payment_name'].".php");
		$sql = "select * from ".PAYMENT." where payment_type='".$payments[$i]["payment_name"]."'";
		$db->query($sql);
		$payment_one = $db->fetchRow();
		if ($payment_one) {
			$name = $payment_one['payment_name'];
			$desc = $payment_one['payment_desc'];
			$commission = $payment_one['payment_commission'];
			$active = $payment_one['active'];
		} else {
			$name = lang_show($payments[$i]["payment_name"]);
			$commission = $payments[$i]["payment_commission"];
			$desc = lang_show($payments[$i]["payment_name"].'_desc');
			$active = 0;
		}
	?>
        <tr  onMouseOver="mouseOver(this)" onMouseOut="mouseOut(this,'odd')">
          <td><?php echo $name; ?></td>
          <td align="left"><?php echo $desc; ?></td>
          <td align="center"><?php echo $payments[$i]["version"]; ?></td>
          <td align="center"><?php echo $commission; ?></td>
          <td align="center">
		  <?php
			if($active==0) {
				echo '<a href="paymentmod.php?step=active&payment_type='.$payments[$i]["payment_name"].'">'.lang_show('payment_f').'</a>';
			} else {
				echo '<a onClick="return confirm(\''.lang_show('are_you_sure').'\')" href="payment.php?step=unset&payment_type='.$payments[$i]["payment_name"].'">'.lang_show('payment_g').'</a> |';
				echo '<a href="paymentmod.php?step=edit&payment_type='.$payments[$i]["payment_name"].'">'.lang_show('edit').'</a>';
			}
		?>
		  </td>
          <?php 
    	}
		?>
        </tr>
      </table>
	</div>
</div>
</form>
</body>
</html>
