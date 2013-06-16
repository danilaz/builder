<?php
$unit_time=24; //unit_time为刷新与现在距离时间之前的所有信息，单位为小时；
$info_type=2;  //info_type为要刷新的类型;1为产品，2为产品，
$group=NULL;   //ifpay为刷新的会员组
//====================================

$d=$unit_time*3600;
$nt=date("Y-m-d H:m:s");
if(!empty($group))
{
	$sqlu="select userid from ".USER." where ifpay='".$group."'";
	$db->query($sqlu);
	$de=$db->getRows();
	if(is_array($de["userid"]))
		$usid=explode(",",$de["userid"]);
	else
		$usid=0;
	if($info_type==1)		
		$sql="update ".PRO." set uptime=$nt where UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(uptime)>=$d and userid in($usid)";
	if($info_type==2)		
		$sql="update ".INFO." set uptime=$nt where UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(uptime)>=$d and userid in($usid)";
	$db->query($sql);
}
else
{
	if($info_type==1)		
		$sql="update ".PRO." set uptime=$nt where UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(uptime)>=$d";
	if($info_type==2)		
		$sql="update ".INFO." set uptime=$nt where UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(uptime)>=$d";
	$db->query($sql);
}                

?>