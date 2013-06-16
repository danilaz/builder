<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//============================================
if(!empty($_POST['user'])&&!isset($_GET['id']))
{
	foreach($_POST as $key=>$v)
	{
		$_POST[$key]=trim($_POST[$key]);
	}
	$sql="select * from ".ADMIN." WHERE user='$_POST[user]'";
	$db->query($sql);
	if(!$db->num_rows())
	{
		$_POST['password']=md5($_POST['password']);
		$sql="insert into ".ADMIN."
		 (user,password,group_id,`desc`,province,city)
		  VALUES
		 ('$_POST[user]','$_POST[password]','$_POST[group_id]','$_POST[desc]','$_POST[provinces]','$_POST[citys]')";
		 $re=$db->query($sql);
		 if($re)
			msg("admin_manager.php");
	}
	else
		msg("add_admin_manager.php?type=1");
}
if(!empty($_POST['group_id'])&&!empty($_GET['id']))
{
	if(!empty($_POST['password']))
	{
		$_POST['password']=md5($_POST['password']);
		$pa="password='$_POST[password]',";
	}
	$sql="update ".ADMIN." set ".$pa." group_id='".$_POST['group_id']."', `desc`='".$_POST['desc']."', province='$_POST[provinces]', city='$_POST[citys]' where id='".$_GET['id']."'";
	$re=$db->query($sql);
	 if($re)
		msg("admin_manager.php");
}

//---------是否有会员组存在，不存在就转向增加会员组功能。
if($_SESSION['province'])
	$tsql=" and province='$_SESSION[province]'";
if($_SESSION['city'])
	$tsql.=" and city='$_SESSION[city]'";
	
$sql="select * from ".GROUP." where 1=1 $tsql order by group_id desc";
$db->query($sql);
$havegroup=$db->getRows();
if(count($havegroup)==0)
	msg('group.php');
//-----------------------------------------------
if(!empty($_GET['id']))
{
	$sql="select * from ".ADMIN." where id='$_GET[id]'";
	$db->query($sql);
	$de=$db->fetchRow();
}
$sql="SELECT a.id, a.user, a.group_id,g.group_name FROM ".ADMIN." a
	LEFT JOIN ".GROUP." g ON a.group_id = g.group_id
	WHERE a.user <> 'admin'";
$db->query($sql);
$users = $db->getRows();
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('add_manager');?></div>
	<div class="bigboxbody">
  <form name="form1" method="post" action="">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <?php
	 if(!empty($_GET['type'])&&$_GET['type']==1)
	 {
	 ?>
	 <tr>
        <td>&nbsp;</td>
        <td><?php echo lang_show('repeat_msg');?></td>
      </tr>
	  <?php }?>
      <tr>
        <td width="10%"><?php echo lang_show('manager_name');?></td>
        <td width="90%">
          <input style="width:200px;" type="text" name="user" value="<?php echo $de['user'];?>" <?php if($de['user']){echo "disabled";}?>>        </td>
      </tr>
      <tr>
        <td><?php echo lang_show('password');?></td>
        <td><input style="width:200px;" type="text" name="password"><?php if(!empty($_GET['id'])){echo lang_show('passmsg');}?></td>
      </tr>
      <tr>
        <td><?php echo lang_show('belonggroup');?></td>
        <td>
          <select style="width:200px;" name="group_id">
		  <?php
		  foreach($havegroup as $v)
		  {
		  	if($v['group_id']==$de['group_id'])
				echo "<option value='".$v['group_id']."' selected >".$v['group_name']."</option>";
			else
		  		echo "<option value='".$v['group_id']."'>".$v['group_name']."</option>";
		  }
		  ?>
          </select>        </td>
      </tr>
      	<tr>
		<td width="10%"><?php echo lang_show('becity');?></td>
		<td><?php include("include_prv_city.php");?></td>
	</tr>
      <tr>
        <td><?php echo lang_show('des');?></td>
        <td>
        <textarea style="width:406px;" name="desc" cols="50" rows="7"><?php if(!empty($de['desc'])) echo $de['desc'];?></textarea>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input class="btn" type="submit" name="Submit" value="<?php echo lang_show('submit');?>"></td>
      </tr>
    </table>
    </form>
</div>
</div>
</body>
</html>