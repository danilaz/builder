<?php
//定时更新过期的问题
include($config['webroot']."/config/point_config.php");
//统计前一天的记录存入记录总表，并清空前一天的的详细记录表，该函数在每天的第一浏览的时候执行

$sql="select count(*) as num from ".PV;
$db->query($sql);
$rs=$db->fetchRow();
$pvs=$rs['num'];//pv总数
//------------------------------
$sql="select count(distinct ip) as ips from ".PV;
$db->query($sql);
$rs=$db->fetchRow();
$ips=$rs['ips'];//独立ip总数
//-----------------------------------
$sql="select count(url) as urls from ".PV;
$db->query($sql);
$rs=$db->fetchRow();
$urls=$rs['urls'];//url总数
//-------------------------------------
$sql="select  url,count(*) as num from ".PV." group by url order by num desc limit 1";
$db->query($sql);
$rs=$db->fetchRow();
$mostpopurl=$rs['url'];//最受欢迎的url
if(empty($mostpopurl))
	$mostpopurl = 0;
//-----------------------------------
$sql="select count(distinct username) as users from ".PV;
$db->query($sql);
$rs=$db->fetchRow();
$onusers=$rs['users'];//上线会员数
if (empty($onusers))
	 $onusers=0;
//-----------------------------------
//前一天所有注册的新的会员
$sql="select count(*) as reguser from ".USER." where TO_DAYS(NOW())-TO_DAYS(regtime)<=1";
$db->query($sql);
$rs=$db->fetchRow();
$nregusers=$rs['reguser'];//新注册会员数
if (empty($nregusers))
	$nregusers=0;
//-----------------------------------
//前一天发布产品数
$sql="select count(*) as pros from ".PRO." where TO_DAYS(NOW())-TO_DAYS(uptime)<=1";
$db->query($sql);
$rs=$db->fetchRow();
$prods=$rs['pros'];//新发布产品数
if (empty($prods))
	$prods=0;
//---------------前一天发布产品数
$sql="select count(*) as offers from ".INFO." where TO_DAYS(NOW())-TO_DAYS(uptime)<=1";
$db->query($sql);
$rs=$db->fetchRow();
$offers=$rs['offers'];
if(empty($offers))
	$offers=0;
//---------------前一天发招产品数
/*
$sql="select count(*) as project from ".PROJECT." where TO_DAYS(NOW())-TO_DAYS(uptime)<=1";
$db->query($sql);
$rs=$db->fetchRow();
$project=$rs['project'];
if(empty($project))
	$project=0;
*/
//-----------------------------------------
//前一天发布资讯数
$sql="select count(*) as newss from ".NEWSD." where TO_DAYS(NOW())-TO_DAYS(uptime)<=1";
$db->query($sql);
$rs=$db->fetchRow();
$newss=$rs['newss'];//新发布资讯数
if (empty($newss))
	$newss=0;
//前一天发布展会数
$sql="select count(*) as exhibs from ".EXHIBIT." where TO_DAYS(NOW())-TO_DAYS(addTime)<=1";
$db->query($sql);
$rs=$db->fetchRow();
$exhs=$rs['exhibs'];//新发布展会数
if (empty($exhs))
	$exhs=0;
//前一天发布视频数
$sql="select count(*) as videos from ".VIDEO." where TO_DAYS(NOW())-TO_DAYS(time)<=1";
$db->query($sql);
$rs=$db->fetchRow();
$videos=$rs['videos'];//新发布视频数
if (empty($videos))
	$videos=0;
//以下是写入记录总表

$ntime=date("Y-m-d H:i:s");
$sql=$sql="insert into ".PAGEREC."
	(totalurl,mostpopularurl,pageviews,totalip,visitusernum,reguser,pronum,offernum,newsnum,exhibnum,videonum,time,projnum)
	values
	('$urls','$mostpopurl','$pvs','$ips','$onusers','$nregusers','$prods','$offers','$newss','$exhs','$videos','$ntime','$project')";
$db->query($sql);
//一下是清空详细记录表的记录
$sql="delete from ".PV;
$db->query($sql);
?>