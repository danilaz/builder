<?php
if (!empty($_GET['searchkey']))
{
    echo "Результаты: ";
	$usql="SELECT *  FROM ".INFO." where title like '%".$_GET['searchkey']."%' limit 4";
    $db->query($usql);
	$myrs=$db->getRows();
	if(count($myrs)>0)
	{     
	    foreach($myrs as $v)
	    {
		   $usql="SELECT a.title  ,b.company  FROM ".INFO." a INNER JOIN ".USER." b ON (a.userid = b.userid) where a.userid='".$v['userid']."' limit 4";
           $db->query($usql);
		   $mrs=$db->fetchRow();
		   echo "<br/>[Компания] [<a href='?action=corporate_detail&coid=".$v['userid']."'>".$mrs['company']."</a>]";
           echo "<br/>[Продукты] <a href='?action=offer_detail&offerid=".$v['id']."'>".$v['title']."</a>";
	    }
	}
	$sql="SELECT * FROM ".NEWS." where title like '%".$_GET['searchkey']."%' limit 4";
    $db->query($sql);
	if ($db->num_rows()>0)
	{
       $rs=$db->getRows();
       foreach($rs as $v)
       {
           echo "<br/>[Новости] <a href='?action=news_detail&newsid=".$v['newsid']."'>".$v['title']."</a>";
       }
	}
	$sql="SELECT * FROM ".PRO." where pname like '%".$_GET['searchkey']."%' limit 4";
    $db->query($sql);
	if ($db->num_rows()>0)
	{
       $rs=$db->getRows();
       foreach($rs as $v)
       {
           echo "<br/>[Продукты]<a href='?action=product_detail&productid=".$v['id']."'>".$v['pname']."</a>";
       }
	}
	echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=home'>Вернуться</a><br/>";
}
else
{
    header("Location:./?action=home");
	exit();
}
?>