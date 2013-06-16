<?php
include_once("../includes/global.php");
header("Pragma: no-cache");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//==================================
if(isset($_POST["action"]))
{
$sql = "update ".BUSINESS." set com_reg_name='$_POST[com_reg_name]',com_reg_id='$_POST[com_reg_id]',com_reg_add='$_POST[com_reg_add]',com_deputy='$_POST[com_deputy]',com_reg_capital='$_POST[com_reg_capital]',com_reg_type='$_POST[com_reg_type]',com_reg_time='$_POST[com_reg_time]',com_reg_time_ex='$_POST[com_reg_time_ex]',com_reg_area='$_POST[com_reg_area]',com_reg_unit='$_POST[com_reg_unit]',com_check='$_POST[com_check]',statu='$_POST[statu]' where id='$_POST[id]'";
	$re=$db->query($sql);
	if($re)
	{
		msg("business_info_list.php");
	}
}
//=====================================================
$sql="select * from ".BUSINESS." where id='$_GET[id]'";
$db->query($sql);
$re=$db->fetchRow();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('business_info_manager');?></div>
	<div class="bigboxbody">

        <table width='98%' border='0' cellspacing='0' cellpadding='0' bordercolor='#000000' bordercolorlight='#000000' bordercolordark='#FFFFFF' align="center" class="menu">
		<form method="post" action=""  name="cityform">
		<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
          <tr>
            <td width="10%"><?php echo lang_show('business_info_uptime');?></td>
			<td width="90%"><?php echo $re['uptime'];?>			</td>
          </tr>
          <tr>
            <td><?php echo lang_show('business_info_name');?></td>
			<td><?php echo $re['person_name']; ?>			</td>
          </tr>
          <tr>
            <td><?php echo lang_show('business_info_job');?></td>
			<td><?php echo $re['job'];?>			</td>
          </tr>
		  <tr>
            <td><?php echo lang_show('business_info_com');?></td>
			<td><input name="com_reg_name" type="text" value="<?php echo $re['com_reg_name']; ?>" size="60"/>			</td>
          </tr>
		  <tr>
            <td><?php echo lang_show('business_info_id');?></td>
			<td><input name="com_reg_id" type="text" value="<?php echo $re['com_reg_id']; ?>" size="60"/>			</td>
          </tr>
		  <tr>
            <td><?php echo lang_show('business_info_add');?></td>
			<td><input name="com_reg_add" type="text" value="<?php echo $re['com_reg_add']; ?>" size="60"/>			</td>
          </tr>
		  <tr>
            <td><?php echo lang_show('business_info_deputy');?></td>
			<td><input name="com_deputy" type="text" value="<?php echo $re['com_deputy']; ?>" size="60"/>			</td>
          </tr>
		  <tr>
            <td><?php echo lang_show('business_info_capital');?></td>
			<td><input name="com_reg_capital" type="text" value="<?php echo $re['com_reg_capital']; ?>" size="60"/>			</td>
          </tr>
		  <tr>
            <td><?php echo lang_show('business_info_type');?></td>
			<td><input name="com_reg_type" type="text" value="<?php echo $re['com_reg_type']; ?>" size="60"/>			</td>
          </tr>
		  <tr>
            <td><?php echo lang_show('business_info_time');?></td>
			<td><input name="com_reg_time" type="text" value="<?php echo $re['com_reg_time']; ?>" size="60"/>			</td>
          </tr>
		  <tr>
            <td><?php echo lang_show('business_info_time_ex');?></td>
			<td><input name="com_reg_time_ex" type="text" value="<?php echo $re['com_reg_time_ex']; ?>" size="60"/>			</td>
          </tr>
		  <tr>
		    <td><?php echo lang_show('business_info_time_unit');?></td>
		    <td><input name="com_reg_unit" type="text" value="<?php echo $re['com_reg_unit']; ?>" size="60"/>            </td>
	      </tr>
		  <tr>
            <td><?php echo lang_show('business_info_time_area');?></td>
			<td><textarea name="com_reg_area" id="com_reg_area" rows="8" cols="70"><?php echo $re['com_reg_area']; ?></textarea>			</td>
          </tr>
		  <tr>
            <td><?php echo lang_show('business_info_time_check');?></td>
			<td><input type="text" id="tel" name="com_check" value="<?php echo $re['com_check']; ?>"/>			</td>
          </tr>
		  <tr>
            <td><?php echo lang_show('statu');?></td>
			<td>
			<?php
			  $status=array('0'=>lang_show('notpass'),'1'=>lang_show('auditpass'));
			  ?> 
                <select name="statu">
                <?php 
				foreach($status as $key=>$v)
				{
				?>
                  <option value="<?php echo $key;?>" <?php if($re['statu']==$key)echo "selected";?>>
				  	<?php echo $v;?>                  </option>
                <?php
				 }
				?>
                </select>			</td>
          </tr>
		  <?php if(!empty($re['pic'])){ ?>
		  <tr>
		    <td>&nbsp;</td>
		    <td><img src="<?php echo $re['pic'];?>" /></td>
		    <td>          
	      </tr>
		  <?php } ?>
		  <tr>
            <td>&nbsp;</td>
			<td>
  <input class="btn" type='submit' name='Submit3' value=' <?php echo lang_show('mod');?> '>
  <input name="action" type="hidden" id="action" value="submit"></td>
			</td>
          </tr>
		</form>
        </table>
	</div>
</div>
</body>
</html>
