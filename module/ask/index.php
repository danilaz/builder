<?php
//=========最新问题==================================================
$sql="SELECT a.*,b.cat FROM ".QUESTION." a ,".PCAT." b 
WHERE a.catid=b.catid  and a.statu=1  ORDER BY a.uptime DESC LIMIT 10";
$db->query($sql);
$re=$db->getRows();
$t=time();
foreach($re as $key=>$v)
{
	$nt=$t-$v['uptime'];
	if($nt<60)
		$re[$key]['btime']=$nt.$lang['sago'];
	elseif($nt>60&&$nt<3600)
		$re[$key]['btime']=ceil($nt/60).$lang['mago'];
	elseif($nt>3600&&$nt<86400)
		$re[$key]['btime']=ceil($nt/3600).$lang['hago'];
	elseif($nt>86400&&$nt<2592000)
		$re[$key]['btime']=ceil($nt/86400).$lang['dago'];
	elseif($nt>2592000&&$nt<31104000)
		$re[$key]['btime']=ceil($nt/2592000).$lang['monago'];
	elseif($nt>31104000&&$nt<11352960000)
		$re[$key]['btime']=ceil($nt/2592000).$lang['yago'];
	if($v['statu']==1)
		$re[$key]['img']=$config['weburl'].'/image/default/nask.gif';
	elseif($v['statu']==2)
		$re[$key]['img']=$config['weburl'].'/image/default/answer.gif';
	else
		$re[$key]['img']=$config['weburl'].'/image/default/expired.gif';
}
$tpl->assign("nask",$re);
//==========悬赏问题====================================================
$sql="SELECT a.*,b.cat FROM ".QUESTION." a ,".PCAT." b 
WHERE a.catid=b.catid  and a.reward>0  ORDER BY a.uptime DESC LIMIT 10";
$db->query($sql);
$re=$db->getRows();
$t=time();
foreach($re as $key=>$v)
{
	$nt=$t-$v['uptime'];
	if($nt<60)
		$re[$key]['btime']=$nt.$lang['sago'];
	elseif($nt>60&&$nt<3600)
		$re[$key]['btime']=ceil($nt/60).$lang['mago'];
	elseif($nt>3600&&$nt<86400)
		$re[$key]['btime']=ceil($nt/3600).$lang['hago'];
	elseif($nt>86400&&$nt<2592000)
		$re[$key]['btime']=ceil($nt/86400).$lang['dago'];
	elseif($nt>2592000&&$nt<31104000)
		$re[$key]['btime']=ceil($nt/2592000).$lang['monago'];
	elseif($nt>31104000&&$nt<11352960000)
		$re[$key]['btime']=ceil($nt/2592000).$lang['yago'];
	if($v['statu']==1)
		$re[$key]['img']=$config['weburl'].'/image/default/nask.gif';
	elseif($v['statu']==2)
		$re[$key]['img']=$config['weburl'].'/image/default/answer.gif';
	else
		$re[$key]['img']=$config['weburl'].'/image/default/expired.gif';
}
$tpl->assign("reward",$re);
unset($re);
//========分类============
$db->query("SELECT * FROM ".PCAT." WHERE catid<9999 ORDER BY nums");
$re=$db->getRows();
foreach($re as $key=>$v)
{
	 $re[$key]["sub"]=readsubcat($v["catid"]);
}
$tpl->assign("cat",$re);
unset($re);
//========统计============
$db->query("SELECT count(*) as zs FROM ".QUESTION." where statu=1");
$re=$db->fetchRow();
if(!empty($re['zs']))
	$tpl->assign("newq",$re['zs']);
else
	$tpl->assign("newq",'0');
$db->query("SELECT count(*) as zs FROM ".QUESTION." where statu=2");
$re=$db->fetchRow();
if(!empty($re['zs']))
	$tpl->assign("resq",$re['zs']);
else
	$tpl->assign("resq",'0');
$db->query("SELECT count(*) as zs FROM ".QUESTION." where reward>0");
$re=$db->fetchRow();
if(!empty($re['zs']))
	$tpl->assign("rewq",$re['zs']);
else
	$tpl->assign("rewq",'0');
//==========百事通===========
$db->query("SELECT b.user,b.userid,b.logo,b.point,count(*) as resn FROM ".ANSWER." a, ".USER." b 
where a.userid=b.userid and a.best_answer=1 group by a.userid order by resn desc limit 10");
$re=$db->getRows();
$tpl->assign("knowall",$re);
unset($re);
//===========================
$tpl->assign("current","ask");
include("footer.php");
$out=tplfetch("ask_index.htm");
?>