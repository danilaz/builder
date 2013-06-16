<?php
include_once("../includes/global.php");
include_once("../config/config.inc.php");
if(!empty($_GET['limit'])&&is_numeric($_GET['limit']))
   $limit=$_GET['limit'];
else
   $limit=10;
if(!empty($_GET['class'])&&$_GET['class']=='pro')
{
	   if($_GET['type']=='new')
		   $sql="SELECT * from ".PRO." where statu>0 order by rank desc,uptime desc limit ".$limit;
	   if($_GET['type']=='rec')
			$sql="SELECT * from ".PRO." where statu=2 order by rank desc,uptime desc limit ".$limit;
	   if(empty($sql))die();
	   $db->query($sql);
	   $prol=$db->getRows();
	   $str='';
	   foreach($prol as $v)
	   {
		   if(!empty($_GET['img']))
				$img="<img src='".$config['weburl']."/uploadfile/comimg/small/".$v['id'].".jpg'/><br>";
		   else
			   $img='';
		   $str.="<li>".$img."<a href='".$config['weburl']."/shop.php?action=prod&uid=".$v['userid']."&id=".$v['id']."' target='_blank'>".$v['pname']."</a></li>";
	   }
}
if(!empty($_GET['class'])&&$_GET['class']=='offer')
{
       if($_GET['type']=='new')
		   $sql="SELECT a.*,b.country,b.province,b.city from ".INFO." a left join ".USER." b on a.userid=b.userid where a.statu>0 order by a.rank desc,a.uptime desc limit ".$limit;
	   if($_GET['type']=='rec')
			$sql="SELECT a.*,b.country,b.province,b.city from ".INFO." a left join ".USER." b on a.userid=b.userid where a.statu>1 order by a.rank desc,a.uptime desc limit ".$limit;
	   if($_GET['type']=='buy')
			$sql="SELECT a.*,b.country,b.province,b.city from ".INFO." a left join ".USER." b on a.userid=b.userid where a.statu>0 and a.type=1 order by a.rank desc,a.uptime desc limit ".$limit;
	   if($_GET['type']=='sell')
			$sql="SELECT a.*,b.country,b.province,b.city from ".INFO." a left join ".USER." b on a.userid=b.userid where a.statu>0 and a.type=2 order by a.rank desc,a.uptime desc limit ".$limit;
	   if(empty($sql))die();
	   $db->query($sql);
	   $offer=$db->getRows();
	   $str='';
	   foreach($offer as $v)
	   {
		   if(!empty($_GET['imgtype']))
				$img="<img src='".$config['weburl'].'/image/'.$config['temp'].'/offer_'.$v['type'].".gif'/>";
		   else
			    $img='';
		   if(!empty($_GET['time']))
				$t="<span class='timeformat'>[".dateformat($v['uptime']).']</span>';
		   else
			    $t='';
		   if (!empty($_GET['flag']))
			{
				$sqlo="select flag from ".COUNTRY." where id='".$v['country']."'";
				$db ->query($sqlo);
				$ns=$db->fetchRow();
                $f="<img src='".$config['weburl']."/image/cflag/".$ns['flag'].".gif' />";
			}
		   else
				$f='';
		   if(!empty($_GET['area']))
				$a="<span class='areaformat'>[".$v['province'].'-'.$v['city'].']</span>';
		   else
			    $a='';
		   $str.="<li>".$f.$img.$a."<a href='".$config['weburl']."/shop.php?action=infod&uid=".$v['userid']."&id=".$v['id']."' target='_blank'>".$v['title']."</a>".$t."</li>";
	   }
}
?>
document.write("<?php echo $str;?>");