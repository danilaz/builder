<?php
if (!empty($_GET['productid']))
{
    $productid=$_GET['productid'];
    $sql="SELECT * FROM ".PRO." where id=$productid";
    $db->query($sql);
    $rs=$db->fetchRow();
	echo "<img src=\"".$config['weburl'].'uploadfile/comimg/small/'.$rs['id'].'.jpg" alt="'.$rs['pname'].'" height=80 width=60/><br/>';
	echo "&nbsp;&nbsp;&nbsp;<a href='?action=product_showimg&imgid=".$productid."'><small>Оригинал</small></a><br/>'";
    $content=$rs['con'];
    echo "<p>$content</p>";
	//echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=product_cat'>返回</a><br/>";
	echo "<anchor>Вернуться<prev/></anchor><br/>";
}
else
{
    header("Location:./?action=product_list");
	exit();
}
?>