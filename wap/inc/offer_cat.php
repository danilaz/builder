<?php
$cid=empty($_GET['cid'])?NULL:$_GET['cid'];
if(empty($cid))
{
	$sql="SELECT * FROM ".OCAT." WHERE catid<9999 ORDER BY nums";
	$db->query($sql);
	$re=$db->getRows();
	if(count($re)>0)
	{
	    foreach($re as $v)
	    {
		    echo "[产品]<a href='?action=offer_cat&cid=".$v['catid']."'>".$v['cat']."</a><br/>";
	    }
	    echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=home'>Вернуться</a><br/>";
		//echo "   <anchor>后退<prev/></anchor><br/>";
	}
	else
	{
		header("Location:./?action=home");
	exit();
	}
}
//子类别
if(!empty($cid))
{
	$sid=$cid."00";
    $bid=$cid."99";
    $sql="select * from ".OCAT." where catid>=$sid and catid<=$bid order by nums asc";
    $db->query($sql);
    $sre=$db->getRows();
	if(count($sre)>0)
	{
		foreach($sre as $v)
		{
			echo "[产品]<a href='?action=offer_cat&cid=".$v['catid']."'>".$v['cat']."</a><br/>";
		}
		echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=offer_cat'>Вернуться</a><br/>";
		//echo "<anchor>返回<prev/></anchor><br/>";
	}
	else
	{
		header("Location:./?action=offer_list&cid=".$cid);
	exit();
	}
}
?>