<?php
if(empty($_GET['pid']))
{
	$db->query("select * from ".PCAT." where catid<=9999 order by nums asc");
    $re=$db->getRows();
	if(count($re)>0)
	{
	    foreach($re as $v)
	    {
		    echo "[产品]<a href='?action=product_cat&pid=".$v['catid']."'>".$v['cat']."</a><br/>";
	    }
	    echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=home'><i>Вернуться</i></a><br/>";
		//echo "<anchor>返回<prev/></anchor><br/>";
	}
	else
	{
		header("Location:./?action=home");
	    exit();
	}
}
//子类别
if(!empty($_GET['pid']))
{
	$pid=$_GET['pid'];
	$sid=$pid."00";
    $bid=$pid."99";
    $sql="select * from ".PCAT." where catid>=$sid and catid<=$bid order by nums asc";
    $db->query($sql);
    $sre=$db->getRows();
	if(count($sre)>0)
	{
		foreach($sre as $v)
		{
			echo "[Продукты]<a href='?action=product_list&pid=".$v['catid']."'>".$v['cat']."</a><br/>";
		}
		echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=product_cat'><i>Вернуться</i></a><br/>";
		//echo "<anchor>返回<prev/></anchor><br/>";
	}
	else
	{
		header("Location:./?action=product_list&pid=".$pid);
	exit();
	}
}
?>