<?php
include_once("../includes/global.php");
include_once("../includes/tag_inc.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//========================
if(isset($_POST["action"]))
{
	if(isset($_POST["result"])) {
		$add_time = time();
		if($_POST["result"]==1) {
			$sql = "update ".ACCOUNTS." set active=1, check_time='$add_time', censor='$_SESSION[ADMIN_USER]' where id=$_POST[id]";
			$db->query($sql);
		}
	}
	msg("bank_account.php");
}
//===================
$sql = "select a.*,b.company from ".ACCOUNTS." a, ".USER." b where a.userid=b.userid and a.id='$_GET[id]'";
$db->query($sql);
while($db->next_record())
{
	$id=$db->f('id');
	$bank=$db->f('bank');
	$accounts=$db->f('accounts');
	$master=$db->f('master');
	$add_time=$db->f('add_time');
	$userid=$db->f('userid');
	$active=$db->f('active');
	$censor=$db->f('censor');
	$check_time=$db->f('check_time');
	$company=$db->f('company');
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
	<div class="bigboxhead"><?php echo lang_show('bankm_a');?></div>
	<div class="bigboxbody">
        <form name="form1" method="post" action="">
          <table width="100%" border="0" cellpadding="4" cellspacing="0">
            <tr>
			  <input name="id" type="hidden" id="id" value="<?php echo $id;?>">
			  <input name="userid" type="hidden" id="userid" value="<?php echo $userid;?>">
              <td width="99" align="right"><?php echo lang_show('bankm_b');?></td>
              <td><?php echo $company; ?></td>
            </tr>
            <tr>
              <td align="right"><?php echo lang_show('bankm_c');?></td>
              <td><?php echo $bank; ?></td>
            </tr>
            <tr>
              <td align="right"><?php echo lang_show('bankm_d');?></td>
              <td><?php echo $master; ?></td>
            </tr>
            <tr>
              <td align="right"><?php echo lang_show('bankm_e');?></td>
              <td><?php echo $accounts; ?></td>
            </tr>
            <tr>
              <td align="right"><?php echo lang_show('bankm_f');?></td>
              <td>
			  <?php
				if($active==0){
					?>
			  <input type="radio" name="result" value="0" id="r0" <?php
			  if($active==0) echo "checked"; ?>><label for="r0"><?php echo lang_show('bankm_g');?></label>
			  <input type="radio" name="result" value="1" id="r1" <?php
			  if($active==1) echo "checked"; ?>><label for="r1"><?php echo lang_show('bankm_h');?></label>
			  <?php
				} else {
						?>
			  <?php if($active==1) echo lang_show('bankm_h'); ?>
			<?php
						}
			?>
			  </td>
            </tr>
			  <?php
				if($active==0) {
					?>
            <tr > 
              <td height="20" align="center">&nbsp;</td>
              <td height="20" align="left">
                <input name="cc1" class="btn" type="submit" id="cc1" value=" <?php echo lang_show('modify');?> ">
                <input name="action" type="hidden" id="action" value="submit"></td>
            </tr>
			  <?php
				} else {
						?>
            <tr>
              <td align="right"><?php echo lang_show('bankm_j');?></td>
              <td><?php echo $censor; ?></td>
            </tr>
            <tr>
              <td align="right"><?php echo lang_show('bankm_k');?></td>
              <td><?php echo dateformat($check_time); ?></td>
            </tr>
			<?php
						}
			?>
          </table>
      </form>
</div>
</div>

</body>
</html>