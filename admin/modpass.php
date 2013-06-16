<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//============================================
if(!empty($_POST["cc"]))
{
	$password=md5($_POST["password"]);
	$db->query("select * from ".ADMIN." where user='".$_SESSION["ADMIN_USER"]."' and password='$password'");
	if($db->next_record())
	{
		$newpass=md5($_POST["newpass"]);
		$db->query("update ".ADMIN." set password='$newpass'  where user='".$_SESSION["ADMIN_USER"]."'");
		echo "<br><p align=center>".lang_show('modok')."</p>";
	}
}
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
<body>
<form method="post" action="">
  <div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('mod_password');?></div>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('mod_password');?></div>
	<div class="bigboxbody">
  <table width="100%" border="0" cellspacing="1" cellpadding="4" align="center">
    <tr> 
      <td width="15%" height="25"> 
        <?php echo lang_show('username');?>:      </td>
      <td width="85%" height="25"> 
         <?php echo $_SESSION["ADMIN_USER"]; ?>
        </td>
    </tr>
    <tr> 
      <td width="15%" height="25"> 
        <?php echo lang_show('old_password');?>:      </td>
      <td width="85%" height="25"> 
         <input style="width:200px;" type="password" name="password" value="">
         </td>
    </tr>
    <tr> 
      <td width="15%" height="25"> 
        <?php echo lang_show('new_password');?>:      </td>
      <td width="85%" height="25"> 
        <input style="width:200px;" type="password" name="newpass">
        </td>
    </tr>
    <tr> 
      <td width="15%" height="25"> 
        <?php echo lang_show('repeat_new_password');?>:      </td>
      <td width="85%" height="25"> 
         <input style="width:200px;" type="password" name="repass">
        </td>
    </tr>
    <tr> 
      <td width="15%" height="25">&nbsp; </td>
      <td width="85%" height="25"> 
        <input class="btn" type="submit" name="cc" value="<?php echo lang_show('submit');?>">
       </td>
    </tr>
  </table>
  </div>
</div>
</form>
</body>
</html>
