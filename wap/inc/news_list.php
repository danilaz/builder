<?php
//$cid=empty($_GET['cid'])?NULL:$_GET['cid'];
//===============================================
if (!empty($_GET['newsid']))
{
	$newsid=$_GET['newsid'];
    include_once("../includes/page_utf_class.php");
    $sql="SELECT * FROM ".NEWS." where catid=$newsid";
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
           echo "$i.<a href='?action=news_detail&newsid=".$v['newsid']."'>".$v['title']."</a><br/>";
		   $i=$i+1;
       }
	   echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=news_cat'><i>Вернуться</i></a><br/>";
	   //echo "<anchor>返回<prev/></anchor><br/>";
	}
	else
    {
	   echo "Нет записей";
       echo "<br/><a href='?action=news_cat'><i>Вернуться</i></a><br/>";
	}
}
else
{
	header("Location:./?action=news_list&newsid=".$newsid);
	exit();
}
?>