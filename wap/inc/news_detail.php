<?php
if (!empty($_GET['newsid']))
{
    $newsid=$_GET['newsid'];
    $sql="SELECT body FROM ".NEWS." where newsid=$newsid";
    $db->query($sql);
    $rs=$db->fetchRow();
    $content=$rs['body'];
    echo "<p>$content</p>";
	echo "<br/><a href='?action=news_cat'>Вернуться</a>";
	echo "<anchor>Вступление<prev/></anchor><br/>";
}
else
{
    header("Location:./?action=news_list");
	exit();
}
?>