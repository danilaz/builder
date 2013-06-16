<?php
$sql="select distinct userid from ".SUBSCRIBE;
$db->query($sql);
$re=$db->getRows();
foreach($re as $v)
{
	$sqlu="select * from ".SUBSCRIBE." where userid='".$v['userid']."' and  TO_DAYS(now())-TO_DAYS(FROM_UNIXTIME(uptime))<=validity";
	$db->query($sqlu);
	$rsu=$db->getRows();
	$str='';
	$is_exite=False;
	foreach($rsu as $s)
	{	
		$rt=$s['lastreceivetime']-25920000;
		$lastrectime=date("Y-m-d H:m:s",$rt);
		$days=(time()-$s['lastreceivetime'])/86400;
		if($days>=$s['frequency'])
		{
				if($s['ktype']==1)
				{
					$sqlm="select distinct a.id,a.pname,a.userid from ".PRO." a left join ".CTAGS." b on a.id=b.tid  where  a.statu>0 and a.uptime>='$lastrectime' and b.tagname like '%$s[keywords]%' and b.type=1 order by a.uptime desc limit 5";
					$db->query($sqlm);
					$res=$db->getRows();
					if(count($res)>0)
					{
						$is_exite=true;
						$sql="update ".SUBSCRIBE." set lastreceivetime='".time()."' where id='".$s['id']."'";
						$db->query($sql);
					}
					foreach($res as $va)
					{
						$str.="<a href='".$config['weburl']."/shop.php?uid=".$va['userid']."&action=prod&id=".$va['id']."' target='_blank'>".$va['pname']."</a>&nbsp;&nbsp;&nbsp;";
					}
					$str.="<br />--------------------------Product--------------------------<br/>";
				}
				if($s['ktype']==2)
				{
					$sqlm="select distinct a.id,a.title,a.userid from ".INFO." a left join ".CTAGS." b on a.id=b.tid  WHERE  a.statu>0 and a.uptime>='$lastrectime' and b.tagname like '%$s[keywords]%' and b.type=2 order by a.uptime desc limit 5";
					$db->query($sqlm);
					$res=$db->getRows();
					if(count($res)>0)
					{
						$is_exite=true;
						$sql="update ".SUBSCRIBE." set lastreceivetime='".time()."' where id='".$s['id']."'";
						$db->query($sql);
					}
					foreach($res as $va)
					{
						$str.="<a href='".$config['weburl']."/shop.php?uid=".$va['userid']."&action=infod&id=".$va['id']."' target='_blank'>".$va['title']."</a>&nbsp;&nbsp;&nbsp;";
					}
					$str.="<br />--------------------------Offer--------------------------<br/>";
				}
				if($s['ktype']==3)
				{
					$sqlm="select distinct a.id,a.title from ".EXHIBIT." a left join ".CTAGS." b on a.id=b.tid  WHERE  a.statu>0 and a.addTime>='$lastrectime' and b.tagname like '%$s[keywords]%' and b.type=4 order by a.addTime desc limit 5";
					$db->query($sqlm);
					$res=$db->getRows();
					if(count($res)>0)
					{
						$is_exite=true;
						$sql="update ".SUBSCRIBE." set lastreceivetime='".time()."' where id='".$s['id']."'";
						$db->query($sql);
					}
					foreach($res as $va)
					{
						$str.="<a href='".$config['weburl']."/?m=exhibition&s=exhibition_detail&id=".$va['id']."' target='_blank' >".$va['title']."</a>&nbsp;&nbsp;&nbsp;";
					}
					$str.="<br />-------------------------Exhibition-------------------------<br/>";
				}
				if($s['ktype']==4)
				{
					/*
					$sqlm="select distinct userid,id,projecttitle from ".PROJECT." where projecttitle like '%$s[keywords]%' and uptime>='$lastrectime' order by uptime desc limit 5";
					$db->query($sqlm);
					$res=$db->getRows();
					if(count($res)>0)
					{
						$is_exite=true;
						$sql="update ".SUBSCRIBE." set lastreceivetime='".time()."' where id='".$s['id']."'";
						$db->query($sql);
					}
					foreach($res as $va)
					{
						$str.="<a href='".$config['weburl']."/shop.php?action=project&uid=".$va['uid']."&id=".$va['id']."' target='_blank'>".$va['projecttitle']."</a>&nbsp;&nbsp;&nbsp;";
					}
					$str.="<br />--------------------------Investment--------------------------<br/>";
					*/
				}
				if($s['ktype']==5)
				{
					$sqlm="select  distinct a.nid,a.ftitle from ".NEWSD." a left join ".CTAGS." b on a.nid=b.tid where a.uptime>='$lastrectime' and b.tagname like '%$s[keywords]%' and b.type=3 order by a.uptime desc limit 5";
					$db->query($sqlm);
					$res=$db->getRows();
					if(count($res)>0)
					{
						$is_exite=true;
						$sql="update ".SUBSCRIBE." set lastreceivetime='".time()."' where id='".$s['id']."'";
						$db->query($sql);
					}
					foreach($res as $va)
					{
						$str.="<a href='".$config['weburl']."/news_detail.php?id=".$va['newsid']."' target='_blank' >".$va['title'].'</a>&nbsp;&nbsp;&nbsp;';
					}
					$str.="<br />----------------------------News----------------------------<br/>";
				}				
		}//if结束
	}//foreache结束
	if($is_exite==true)
	{
		$sqle="select email from ".USER." where userid='".$v['userid']."'";
		$db->query($sqle);
		$rs=$db->fetchRow();
		$emailaddr=$rs['email'];
		
		$mail_temp=get_mail_template('subscribe');
		$con=$mail_temp['message'];
		$subject=$mail_temp['subject'];
		
		$ar1=array('[content]','[weburl]');
		$ar2=array($str,$config['weburl']);
		$con=str_replace($ar1,$ar2,$con);
		send_mail($emailaddr,'System',$subject,$con);
	}
}
?>