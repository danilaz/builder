<?php
include_once("../../includes/global.php");
if(!empty($_GET['id']))
{
	$sql="select * from ".VCAT." where pid=".$_GET['id'];
	$db->query($sql);
	$re=$db->getRows();
	echo "<select name=\"catid\">";
	foreach($re as $key=>$v)
	{
		if(!empty($_GET['scatid'])&&$_GET['scatid']==$v['id'])
		$str='selected="selected"';
		else
		$str=NULL;
		echo "<option $str value=\"".$v['id']."\">".$v['catname']."</option>";
	}
	echo "</select>";
}
?>