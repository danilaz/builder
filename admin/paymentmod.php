<?php
include_once("../includes/global.php");
include_once("../includes/tag_inc.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//========================
if(!isset($_GET['payment_type'])){
	msg("payment.php");
}
$modules_loading = true;
include_once("payment/".$_GET['payment_type'].".php");
include_once("../lang/" . $config['language'] . "/payment/".$_GET['payment_type'].".php");

if (isset($_POST["action"])) {
	$sql = "select * from ".PAYMENT." where payment_type='".$_GET['payment_type']."'";
	$db->query($sql);
	$pament_one = $db->fetchRow();
	$configs = array();
	if (isset($_POST['config']) && is_array($_POST['config'])) {
		for($i=0;$i<count($_POST['config']);$i++){
			$configs[$i] = array(
					'name' => $_POST['config_name'][$i],
					'type' => $_POST['config_type'][$i],
					'value' => $_POST['config'][$i],
				);
		}
		$configs_str = serialize($configs);
	}
	if($pament_one){
		$sql = "update ".PAYMENT." set payment_name='$_POST[payment_name]',payment_desc='$_POST[payment_desc]',payment_commission='$_POST[payment_commission]',payment_config='$configs_str',active='1' where payment_type='$_POST[payment_type]'";
	} else {
		$sql = "insert into ".PAYMENT." (payment_type,payment_name, payment_desc, payment_commission, payment_config, active) values('$_POST[payment_type]','$_POST[payment_name]','$_POST[payment_desc]','$_POST[payment_commission]','$configs_str','1')";
	}
	$db->query($sql);
	msg("payment.php");
}

$sql = "select * from ".PAYMENT." where payment_type='".$_GET['payment_type']."'";
$db->query($sql);
$payment_one = $db->fetchRow();

if ($payment_one) {
	$name = $payment_one['payment_name'];
	$desc = $payment_one['payment_desc'];
	$commission = $payment_one['payment_commission'];
	$configs = unserialize($payment_one['payment_config']);
} else {
	$name = lang_show($modules_list[0]['payment_name']);
	$desc = lang_show($modules_list[0]['payment_name'].'_desc');
	$commission = $modules_list[0]['payment_commission'];
	$configs = $modules_list[0]['payment_config'];
}
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('pay_edit_a');?></div>
	<div class="bigboxbody">
        <form name="form1" method="post" action="">
          <table width="100%" border="0" cellpadding="4" cellspacing="0">
            <tr>
			  <input name="step" type="hidden" id="step" value="<?php echo $_GET['step'];?>">
			  <input name="payment_type" type="hidden" id="payment_type" value="<?php echo $_GET['payment_type'];?>">
              <td width="99" align="right"><?php echo lang_show('pay_edit_b');?></td>
              <td><input type="text" name="payment_name" value="<?php echo $name; ?>" size="40"></td>
            </tr>
            <tr>
              <td align="right"><?php echo lang_show('pay_edit_c');?></td>
              <td>
			  <textarea name='payment_desc' cols='80' rows='10' id="payment_desc"><?php echo $desc; ?></textarea></td>
            </tr>
			<?php
			for($i=0;$i<count($configs);$i++){
				if ($configs[$i]['type'] == 'text'){
					?>
            <tr>
              <td align="right"><?php echo lang_show($configs[$i]['name']);?></td>
              <td><input type="text" name="config[]" value="<?php echo $configs[$i]['value']; ?>" size="40">
			  <input type="hidden" name="config_name[]" value="<?php echo $configs[$i]['name']; ?>">
			  <input type="hidden" name="config_type[]" value="text">
			  </td>
            </tr>
					<?php
				} else if ($configs[$i]['type'] == 'select') {
					?>
				<input type="hidden" name="config_name[]" value="<?php echo $configs[$i]['name']; ?>">
				<input type="hidden" name="config_type[]" value="select">
					<?php
				}
			}
			?>
            <tr>
              <td align="right"><?php echo lang_show('pay_edit_d');?></td>
              <td><input type="text" name="payment_commission" value="<?php echo $commission; ?>" size="40"></td>
            </tr>
            <tr > 
              <td height="20" align="center">&nbsp;</td>
              <td height="20" align="left">
                <input name="cc1" class="btn" type="submit" id="cc1" value=" <?php echo lang_show('modify');?> ">
                <input name="action" type="hidden" id="action" value="submit"></td>
            </tr>
          </table>
      </form>
</div>
</div>

</body>
</html>