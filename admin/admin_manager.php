<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//====================================================
if(isset($_GET["act"])&&isset($_GET["id"]))
{
	$sql="delete from ".ADMIN." WHERE id='$_GET[id]'";
	$db->query($sql);
}

$subsql=NULL;
if(isset($_GET['group_id']))
{
	$subsql=" and a.group_id='$_GET[group_id]'";
}
if($_SESSION["province"])
	$subsql.=" and a.province='$_SESSION[province]'";
if($_SESSION["city"])
	$subsql.=" and a.city='$_SESSION[city]'";
	
$sql="SELECT a.id, a.user, a.group_id,a.province,a.city,g.group_name FROM ".ADMIN." a
	LEFT JOIN ".GROUP." g ON a.group_id = g.group_id
	WHERE a.user <> 'admin' $subsql order by a.id desc";
	
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
	<div class="bigboxhead"><?php echo lang_show('managerlist');?></div>
	<div class="bigboxbody">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
	<tr > 
		<td width="42" height="24"  >ID</td>
		<td width="430"  ><?php echo lang_show('username');?></td>
		<td width="292" align="left"  ><?php echo lang_show('usergroup');?></td>
		<td width="234" align="left"  ><?php echo lang_show('operation');?></td>
	</tr>
	<?php
		while (list($key,$item) = @each($users))
		{
			echo '<tr>
					<td>'.$item['id'].'</td>
					<td>'.$item['user'].'</td>
					<td>'.$item['group_name'].'</td>
					<td><a href="add_admin_manager.php?act=edit&id='.$item['id'].'">'.$editimg.'</a> <a href="admin_manager.php?act=del&id='.$item['id'].'">'.$delimg.'</a></td>
				</tr>';
		}
	?>
</table>
</div>
</div>
</body>
</html>