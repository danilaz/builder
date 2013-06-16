<?php
	if(!empty($_POST['edituser']))
	{
		if(!empty($_POST['uid'])&&!empty($_POST['id']))
		{	
			$uid=$_POST['uid'];
			$id=$_POST['id'];
			//=======================================
			$sql="update ".ALLUSER." set position='$_POST[position]',mobile='$_POST[mobile]' where userid='$uid'";
			$db->query($sql);
			$sql="update ".USER." set contact='$_POST[contact]',tel='$_POST[tel]',fax='$_POST[fax]',zip='$_POST[zip]',province='$_POST[province]',city='$_POST[city]',addr='$_POST[addr]',url='$_POST[url]' where userid='$uid'";
			$db->query($sql);
			if(!empty($_POST['corrdel'])&&$_POST['corrdel']==1)
				$sql="delete from ".USEREC." where id='$id'";
			else
				$sql="update ".USEREC." SET statu=1 where id='$id'";
			$db->query($sql);
			msg($config['weburl']."/admin/module.php?m=".$_GET['m']."&s=correct_user.php");
		}
	}
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('ecm');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../script/prototype.js"></script>
<script type="text/javascript" src="../script/my_lightbox.js"></script>
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<div class="guidebox"><?php echo lang_show('ecm');?> &raquo; <?php echo lang_show('eci');?></div>
<?php
if(is_numeric($_GET['uid'])&&intval($_GET['uid']>0)&&is_numeric($_GET['id'])&&intval($_GET['id']>0))
{
	$uid=$_GET['uid'];
	$id=$_GET['id'];
	$sql="select * from ".USER." WHERE userid='$uid'";
	$db->query($sql);
	$com=$db->fetchRow();
	if($com)
	{	
		$sql="select qq,msn,skype,position,mobile from ".ALLUSER." where userid='$uid'";
		$db->query($sql);
		$com=array_merge($db->fetchRow(),$com);
		$sql = "select * from ".USEREC." where id='$id' AND userid='$uid'";
		$db->query( $sql );
		$corr_com = $db->fetchRow();
		if($corr_com)
		{
			include_once($config['webroot']."/lang/".$config['language']."/lang_login.php");
			include_once($config['webroot']."/lang/".$config['language']."/user_space/global.php");
			include_once($config['webroot']."/lang/".$config['language']."/user_space/company.php");
 ?>
<form action="" method="post"> 	
	<div class="bigbox">
		<div class="bigboxhead"><?php echo lang_show('ec_mod'); ?></div>
		<div class="bigboxbody">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="15%"><?php echo lang_show('area'); ?></td>
			<td><?php echo $com['province']."·".$com['city']; ?>&nbsp;</td>
			<td><input type="text" value="<?php echo $corr_com['province']; ?>" name="province" />·<input type="text" value="<?php echo $corr_com['city']; ?>" name="city" /></td>
		  </tr>
		  <tr>
			<td><?php echo lang_show('addr'); ?></td>
			<td><?php echo $com['addr']; ?>&nbsp;</td>
			<td><input type="text" value="<?php echo $corr_com['addr']; ?>" style="width:300px" name="addr" />
			 </td>
		  </tr>
		  <tr>
			<td><?php echo lang_show('conetct_name'); ?></td>
			<td><?php echo $com['contact']; ?>(<?php echo $com['position']; ?>)&nbsp;</td>
			<td><input type="text" value="<?php echo $corr_com['contact']; ?>" name="contact" />(<input type="text" value="<?php echo $corr_com['position']; ?>" name="position" />)</td>
		  </tr>
		  <tr>
			<td><?php echo lang_show('tel'); ?></td>
			<td><?php echo $com['tel']; ?>&nbsp;</td>
			<td><input type="text" value="<?php echo $corr_com['tel']; ?>" name="tel" /></td>
		  </tr>
		  <?php 
			if(!empty($com['mobile']))
			{
		  ?>
		  <tr>
			<td><?php echo lang_show('mobile'); ?></td>
			<td><?php echo $com['mobile']; ?>&nbsp;</td>
			<td><input type="text" value="<?php echo $corr_com['mobile']; ?>" name="mobile" /></td>
		  </tr>
		  <?php 
			}
		  ?>
		  <tr>
			<td><?php echo lang_show('fax'); ?></td>
			<td><?php echo $com['fax']; ?>&nbsp;</td>
			<td><input type="text" value="<?php echo $corr_com['fax']; ?>" name="fax" /></td>
		  </tr>
		  <tr>
			<td><?php echo lang_show('post'); ?></td>
			<td><?php echo $com['zip']; ?>&nbsp;</td>
			<td><input type="text" value="<?php echo $corr_com['zip']; ?>" name="zip" /></td>
		  </tr>
		  <tr>
			<td><?php echo lang_show('weburl'); ?></td>
			<td><?php echo $com['url']; ?>&nbsp;</td>
			<td>
			<input type="text" style="width:300px" value="<?php echo $corr_com['url']; ?>" name="url" />
&nbsp;
			</td>
		  </tr>
		  <tr>
			<td colspan=2 style="text-align:center"><?php echo $corr_com['statu']==2?"":"<font color='green'>".lang_show("resucc")."</font>"; ?>&nbsp;</td>
			<td>
				<input name="return" class="btn" type="button" id="return" value="<?php echo  lang_show('ereturn');?>" onClick="history.go(-1);" />&nbsp;
				<input name="edituser" class="btn" type="submit" id="edituser" value="<?php echo  lang_show('isure');?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');" />
				<input name="corrdel" type="checkbox" id="corrdel" value="1" /><?php echo  lang_show('anddel');?>
				<input name="uid" type="hidden" id="uid" value="<?php echo $_GET['uid'];?>">
				<input name="id" type="hidden" id="id" value="<?php echo $_GET['id'];?>">
				<input name="m" type="hidden" id="m" value="<?php echo $_GET['m'];?>">
				<input name="s" type="hidden" id="s" value="<?php echo $_GET['s'];?>">
			</td>
		  </tr>
		</table>   
		</form>
	</div>
</div>
<?php
		}
	}
 }
?>
</body>
</html>