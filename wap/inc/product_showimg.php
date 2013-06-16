<?php
if (!empty($_GET['imgid']))
{
    $productid=$_GET['imgid'];
	echo "<img src=\"".$config['weburl'].'uploadfile/comimg/big/'.$productid.'.jpg" alt="'.$rs['pname'].'"/><br/>';
	//echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=product_cat'>返回</a><br/>";
	echo "<anchor>Вернуться<prev/></anchor><br/>";
}
else
{
    header("Location:./?action=product_list");
	exit();
}
?>