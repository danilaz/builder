<?php
//定时更新过期的问题
include($config['webroot']."/config/point_config.php");
if($point_config['point']=='1')
{
	$nt=time()-864000;
	$sql="select userid,id from ".QUESTION." where answer_nums>0 and statu!=3 and uptime<$nt";
	$db->query($sql);
	$re=$db->getRows();
	if(empty($point_config['question_expired']))
		$point_config['question_expired']=0;
	if(empty($point_config['answer']))
		$point_config['answer']=0;	
	foreach($re as $v)
	{
		$sql="update ".USER." set point=point+$point_config[question_expired] where userid=$v[userid]";
		$db->query($sql);
		$sql="select userid from ".ANSWER." where question_id=$v[id]";
		$db->query($sql);
		$rs=$db->getRows();
		if(!empty($rs['userid']))
		{
			$uid='0';
			foreach($rs as $u)
			{
				$uid.=','.$u['userid'];
			}
			$sql="update ".USER." set point=point+$point_config[answer] where userid in ($uid)";
			$db->query($sql);
		}
	}
	$sql="update ".QUESTION." set statu=3 where uptime<$nt and statu!=3";
	$db->query($sql);
}
?>