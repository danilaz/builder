<?php
//$cid=empty($_GET['cid'])?NULL:$_GET['cid'];
//===============================================
if (!empty($_GET['cid']))
{
	$cid=$_GET['cid'];
    include_once("../includes/page_utf_class.php");
    $sql="SELECT * FROM ".INFO." where catid=$cid";
    $page = new Page;
    $page->listRows=10;
    if (!$page->__get('totalRows'))
    {
	   $db->query($sql);
	   $page->totalRows = $db->num_rows();
    }
    $sql .= "  limit ".$page->firstRow.",10";
    $pages = $page->prompt();
    $db->query($sql);
	if ($db->num_rows()>0)
	{
       $rs=$db->getRows();
	   $i=1;
       foreach($rs as $v)
       {
		   $usql="SELECT a.title  ,b.company  FROM ".INFO." a INNER JOIN ".USER." b ON (a.userid = b.userid) where a.userid='".$v['userid']."'";
           $db->query($usql);
		   $myrs=$db->fetchRow();
		   echo "<small>Компания [<a href='?action=corporate_detail&coid=".$v['userid']."'>".$myrs['company']."</a>]</small>";
           echo "$i.<a href='?action=offer_detail&offerid=".$v['id']."'>".$v['title']."</a><><br/>";
		   $i=$i+1;
       }
	   echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=offer_cat'><i>Вернуться</i></a><br/>";
	   //echo "<anchor>返回<prev/></anchor><br/>";
	}
	else
    {
	   echo "Нет записей";
       echo "<br/><a href='?action=offer_cat'><i>Вернуться</i></a><br/>";
	}
}
else
{
	header("Location:./?action=offer_list&cid=".$cid);
	exit();
}
?>