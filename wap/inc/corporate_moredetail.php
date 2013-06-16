<?php
if (!empty($_GET['uid'])&&!empty($_GET['detail']))
{
    $coid=$_GET['uid'];
	$content=$_GET['detail'];
	if ($content=="intro")
	{
        $sql="SELECT company,intro FROM ".USER." where userid=$coid";
        $db->query($sql);
        $rs=$db->fetchRow();
	    echo "[Информация о компании]<br/>";
	    $intro=$rs['intro'];
	    echo "$intro<br/>";
	    echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=corporate_detail&coid=".$coid."'>Вернуться</a><br/>";
	}
	if ($content=="news")
	{
        $usql="SELECT *  FROM ".NEWS." where userid='".$coid."' order by uptime desc limit 5";
        $db->query($usql);
	    $myrs=$db->getRows();
        if(count($myrs)>0)
	    {
			$i=1;
	        foreach($myrs as $v)
	        {
		       echo $i."<a href='?action=news_detail&newsid=".$v['newsid']."'>".$v['title']."</a><br/>";
			   $i=$i+1;
	        }
	    }
	    echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=corporate_detail&coid=".$coid."'>Вернуться</a><br/>";
	}
    if ($content=="offer")
	{
        $usql="SELECT *  FROM ".INFO." where userid='".$coid."' order by uptime desc limit 5";
        $db->query($usql);
	    $myrs=$db->getRows();
        if(count($myrs)>0)
	    {
			$i=1;
	        foreach($myrs as $v)
	        {
		       echo $i."<a href='?action=offer_detail&offerid=".$v['id']."'>".$v['title']."</a><br/>";
			   $i=$i+1;
	        }
	    }
	    echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=corporate_detail&coid=".$coid."'>Вернуться</a><br/>";
	}
	if ($content=="product")
	{
        $usql="SELECT *  FROM ".PRO." where userid='".$coid."' order by uptime desc limit 5";
        $db->query($usql);
	    $myrs=$db->getRows();
        if(count($myrs)>0)
	    {
			$i=1;
	        foreach($myrs as $key=>$v)
	        {
		       echo $i."<a href='?action=product_detail&productid=".$v['id']."'>".$v['pname']."</a><br/>";
			   $i=$i+1;
	        }
	    }
	    echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=corporate_detail&coid=".$coid."'>Вернуться</a><br/>";
	}
	if ($content=="contact")
	{
        $usql="SELECT * FROM ".USER." where userid=$coid";
        $db->query($usql);
        $rs=$db->fetchRow();
	    $gs=$rs['company'];
		echo "[Компании]: $gs<br>";
		$lx=$rs['contact'];
		echo "[Контакты]: $lx<br>";
		$addr=$rs['addr'];
		echo "[Адрес]: $addr<br>";
		$dh=$rs['tel'];
		$sj=$rs['mobile'];
		$cz=$rs['fax'];
		echo "[Тел / факс]:$dh<br>";
		echo "&nbsp;&nbsp;$sj<br>";
		echo "&nbsp;&nbsp;$cz<br>";
        $curl=$rs['url'];
        echo "[Сайт]: $curl<br>";
		$email=$rs['email'];
        echo "[Email]: $email<br>";
	    echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=corporate_detail&coid=".$coid."'>Вернуться</a><br/>";
	}
}
else
{
    header("Location:./?action=corporate_list");
	exit();
}
?>