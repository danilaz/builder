<?php
if (!empty($_GET['coid']))
{
    $coid=$_GET['coid'];
    $sql="SELECT * FROM ".USER." where userid=$coid";
    $db->query($sql);
    $rs=$db->fetchRow();
	echo "<img src=\"".$config['weburl'].'uploadfile/userimg/'.$rs['logo'].'" alt="'.$rs['company'].'" height=50 width=100/><br/>';
	$gs=$rs['company'];
	echo "$gs <br/>";
    echo "<a href='?action=corporate_moredetail&detail=intro&uid=$coid'>[Компании]</a><br/>";
	echo "<a href='?action=corporate_moredetail&detail=news&uid=$coid'>[Новости]</a> <br/>";
	echo "<a href='?action=corporate_moredetail&detail=offer&uid=$coid'>[Предложения]</a><br/>";
	echo "<a href='?action=corporate_moredetail&detail=product&uid=$coid'>[Продукты]</a><br/>";
    echo "<a href='?action=corporate_moredetail&detail=contact&uid=$coid'>[Контакты]</a><br/>";
	echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=corporate_cat'>Вернуться</a><br>/";
	//echo "<anchor>后退<prev/></anchor><br/>";
}
else
{
    header("Location:./?action=corporate_list");
	exit();
}
?>