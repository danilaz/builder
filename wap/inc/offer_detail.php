<?php
if (!empty($_GET['offerid']))
{
    $offerid=$_GET['offerid'];
    $sql="SELECT * FROM ".INFO." where id=$offerid";
    $db->query($sql);
    $rs=$db->fetchRow();
    $content=$rs['con'];
	$title=$rs['title'];
	echo "[".$title."]<br/>";
    echo "<p>$content</p>";
	//echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=offer_cat'>返回</a><br/>";
	echo "<anchor>Вернуться<prev/></anchor><br/>";
}
else
{
    header("Location:./?action=offer_list");
	exit();
}
?>