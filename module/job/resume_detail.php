<?php
//============================================
include_once("module/job/lang/".$config['language']."/lang_hr_config.php");
include_once("module/job/lang/".$config['language']."/index.php");
$tpl->assign("hrmoney",$hrmoney);
$tpl->assign("job_type",$job_type);
$tpl->assign("degree",$degree);
if(!empty($_GET['id']))
{
	$sql="select a.*,b.catname from ".RESUME." a left join ".HRCAT." b on b.id=a.scatid where a.rid=$_GET[id] order by a.time desc";
	$db->query($sql);
	$re=$db->fetchRow();
	$re['education']=explodearr($re['education']);
	$re['experience_detail']=explodearr($re['experience_detail']);
	$re['language']=explode(",", $re['language']);
	$tpl->assign("resume",$re);
}
function explodearr($str)
{
	$arr=explode("|", $str);
	foreach($arr as $k=>$val){  
		$arr[$k]=explode(",", $val);
	}
	return $arr;
}
$tpl->assign("current","job");
include_once("footer.php");
$out=tplfetch("resume_detail.htm");
?>