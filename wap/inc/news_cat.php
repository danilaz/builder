<?php
if(empty($_GET['nid']))
{
	$db->query("select * from ".NEWSCAT." where pid='0'");
    $re=$db->getRows();
	if(count($re)>0)
	{
	    foreach($re as $v)
	    {
		    echo "[Новости] <a href='?action=news_cat&nid=".$v['catid']."'>".$v['cat']."</a><br/>";
	    }
	    echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=home'><i>Вернуться</i></a><br/>";
		//echo "<anchor>后退<prev/></anchor><br/>";
	}
	else
	{
		header("Location:./?action=home");
	exit();
	}
}
//子类别
if(!empty($_GET['nid']))
{
	$nid=$_GET['nid'];
    $sql="select * from ".NEWSCAT." where pid=$nid";
    $db->query($sql);
    $sre=$db->getRows();
	if(count($sre)>0)
	{
		foreach($sre as $v)
		{
			echo "[Новости] <a href='?action=news_list&newsid=".$v['catid']."'>".$v['cat']."</a><br/>";
		}
		echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=news_cat'><i>Вернуться</i></a><br/>";
		//echo "  <anchor>后退<prev/></anchor><br/>";
	}
	else
	{
		header("Location:./?action=news_list&nid=".$nid);
	exit();
	}
}
?>