<?php
if (!empty($_GET['demandid']))
{
    $demandid=$_GET['demandid'];
    $sql="SELECT * FROM ".INFO." where id=$demandid";
    $db->query($sql);
    $rs=$db->fetchRow();
    $content=$rs['con'];
	$title=$rs['title'];
	echo "[".$title."]<br/>";
    echo "<p>$content</p>";
	//echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=demand_cat'>返回</a><br/>";
	echo "<anchor>Вернуться<prev/></anchor><br/>";
}
else
{
    header("Location:./?action=demand_list");
	exit();
}
?>