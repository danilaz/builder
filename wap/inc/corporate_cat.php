<?php
$coid=empty($_GET['coid'])?NULL:$_GET['coid'];
if(empty($coid))
{
	$sql="SELECT * FROM ".COMPANYCAT." WHERE catid<9999 ORDER BY nums";
	$db->query($sql);
	$re=$db->getRows();
	if(count($re)>0)
	{
	    foreach($re as $v)
	    {
		    echo "[公司]<a href='?action=corporate_cat&coid=".$v['catid']."'>".$v['cat']."</a><br/>";
	    }
	    echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=home'>Вернуться</a><br/> ";
		//echo "<anchor>后退<prev/></anchor><br/>";
	}
	else
	{
		header("Location:./?action=home");
	exit();
	}
}
//子类别
if(!empty($coid))
{
	$sid=$coid."00";
    $bid=$coid."99";
    $sql="select * from ".COMPANYCAT." where catid>=$sid and catid<=$bid order by nums asc";
    $db->query($sql);
    $sre=$db->getRows();
	if(count($sre)>0)
	{
		foreach($sre as $v)
		{
			echo "[公司]<a href='?action=corporate_list&coid=".$v['catid']."'>".$v['cat']."</a><br/>";
		}
		echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=corporate_cat'>Вернуться</a><br/>";
		//echo "<anchor>后退<prev/></anchor><br/>";
	}
	else
	{
		header("Location:./?action=corporate_list&coid=".$coid);
	    exit();
	}
}
?>