<?php
/**
 *　此文件为分数操作文件，涉及分数的增加，使用，充值，获取积分等．
 */

//为登录的会员增加积分
function add_point($value,$uid)
{
	global $db;
	$sql="update ".USER." set point=point+$value WHERE userid='$uid'";
	$db->query($sql);
}
//为会员减积分
function remove_point($value,$uid)
{
	global $db;
	$sql="update ".USER." set point=point-$value WHERE userid='$uid'";
	$db->query($sql);
}
//获取会员积分
function user_point($uid)
{
	global $db;
	$sql="SELECT point FROM ".USER." WHERE userid='$uid'";
	$db->query($sql);
	$re=$db->fetchRow();
	return $re["point"];
}
//记录已登录会员活动，例如，查看别的会员商铺，产品，产品，新闻等
//$uid,表示会员ＩＤ，$tid表示某个内容的主ＩＤ，例如，产品，产品，会员，新闻等与后面的type共同起作用．
//type值：产品1,产品2,会员商铺4,新闻5
function user_read_rec($uid,$tid,$type)
{
	if(!empty($uid)&&!empty($tid)&&!empty($type))
	{
		global $db;
		$time=time();
		$sql="select id from ".READREC." where userid='$uid' and tid='$tid' and type='$type'";
		$db->query($sql);
		if($db->fetchField('id'))
		{
			$db->query("update ".READREC." set time='$time' where userid='$uid' and tid='$tid' and type='$type'");
		}
		else
		{
			$db->query("insert into ".READREC." (userid,tid,type,time) values ('$uid','$tid','$type','$time')");
		}
	}
}
?>