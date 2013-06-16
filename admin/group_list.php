<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
if(isset($_GET["act"])&&isset($_GET["id"]))
{
	$sql="delete from ".GROUP." WHERE group_id='$_GET[id]'";
	$db->query($sql);
}

if($_SESSION["province"])
	$tsql=" and province='$_SESSION[province]'";
if($_SESSION["city"])
	$tsql.=" and city='$_SESSION[city]'";
$sql="SELECT * FROM ".GROUP." WHERE 1 $tsql order by group_id desc";
$db->query($sql);
$groups = $db->getRows();
?>
<HTML>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<link href="main.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></HEAD>
<body>

<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('add_group');?></div>
	<div class="bigboxbody">
	  <table width="100%" border="0" cellpadding="2" cellspacing="0">
	<tr > 
		<td width="42" height="24"  ><?php echo lang_show('group_id');?></td>
		<td width="430"  ><?php echo lang_show('group_name');?></td>
		<td width="234" align="left"  ><?php echo lang_show('operate');?></td>
	</tr>
	<?php
	while (list($key,$item) = @each($groups))
	{
		echo '<tr>
				<td>'.$item['group_id'].'</td>
				<td><a href=admin_manager.php?group_id='.$item['group_id'].'>'.$item['group_name'].'</a></td>
				<td><a href="group.php?act=edit&id='.$item['group_id'].'">'.$editimg.'</a> <a href="?act=del&id='.$item['group_id'].'">'.$delimg.'</a> </td>
			</tr>';
	}
	?>
</table>
</div>
</div>
</body>
</html>