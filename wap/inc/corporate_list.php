<?php
//$cid=empty($_GET['coid'])?NULL:$_GET['coid'];
//===============================================
if (!empty($_GET['coid']))
{
    include_once("../includes/page_utf_class.php");
    $sql="SELECT * FROM ".USER." where ifpay>1 and (catid like '%,$_GET[coid],%')";
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
           echo "$i.<a href='?action=corporate_detail&coid=".$v['userid']."'>".$v['company']."</a><br/>";
		   $i=$i+1;
       }
	  echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=corporate_cat'><i>Вернуться</i></a><br/>";
	  //echo "<anchor>后退<prev/></anchor><br/>";
	}
	else
	{
	   echo "Нет записей";
       echo "<br/><a href='?action=corporate_cat'><i>Вернуться</i></a><br/>";
	}
}
else
{
	header("Location:./?action=corporate_list&coid=".$coid);
	exit();
}
?>