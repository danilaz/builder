<?php
/**
 * 招聘频道页，已做缓存处理
 * 如需改变仅调整这里即可
 */
useCahe();
$flag=md5($dpid.$dcid.$config["temp"].$_COOKIE["langtw"]);
if(!$tpl->is_cached("job_index.htm",$flag))
{	
	include_once("module/job/lang/".$config['language']."/lang_hr_config.php");
	$tpl->assign("hrmoney",$hrmoney);
	$tpl->assign("job_type",$job_type);
	$tpl->assign("degree",$degree);
	//=============================行业类别列表
	$tpl->assign("cat",get_comcat());
	//==============================职业类别
	include_once("module/job/lang/".$config['language']."/lang_hr_config.php");
	$sql="select id,catname from ".HRCAT." order by posid";
    $db->query($sql);
    $hrcat=$db->getRows();
	$tpl->assign("hrcat",$hrcat);
	$tpl->assign("hrdropdate",$hrdropdate);
	
	$tsql=NULL;
	if(!empty($dpid))
		$tsql=" and b.province='$dpid' ";
	if(!empty($dcid))
		$tsql=" and b.city='$dcid' ";
		
	//===============================最新招聘公司		
	$sql="select a.*,b.company from ".ZP." a ,".USER." b where a.userid=b.userid $tsql order by uptime desc limit 0,10";
	$db->query($sql);
	$hrlist=$db->getRows();
	$tpl->assign("hrlist",$hrlist);
	
	//===============================推荐招聘
	$sql="select a.*,b.company,province,city from ".ZP." a ,".USER." b where a.userid=b.userid and a.statu=2 $tsql limit 0,10";
	$db->query($sql);
	$hrlist=$db->getRows();
	$tpl->assign("rechrlist",$hrlist);
	
	//===============================推荐人才
	$sql="select * from ".RESUME." a  left join ".HRCAT." c on a.scatid=c.id,".USER." b  where a.userid=b.userid and a.statu=1 $tsql limit 0,10";
	$db->query($sql);
	$re=$db->getRows();

	$tpl->assign("resume",$re);
}
$tpl->assign("current","job");
include_once("footer.php");
$out=tplfetch("job_index.htm",$flag);
?>