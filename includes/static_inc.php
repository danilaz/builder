<?php
function stati($type='',$uid='')
{
	global $config,$tpl,$db;
	//================被收藏数===========
	$db->query("select count(*) as favs from ".FAVORITE." where type=$type and fromid='$uid' ");
	$fas=$db->fetchRow();
	$tpl->assign("mfavs",$fas['favs']);
	//================评论数===========
	$db->query("select count(*) as revis from ".COMMENT." where ctype=$type and conid='$uid'");
	$revs=$db->fetchRow();
	$tpl->assign("reviews",$revs['revis']);
}
function insert_stati_favorite($ar)
{
	global $config,$tpl,$db;
	$type=$ar['type'];
	$uid=$ar['conid'];
	$db->query("select count(*) as favs from ".FAVORITE." where type=$type and fromid='$uid' ");
	$fas=$db->fetchRow();
	return $fas['favs'];
}
function insert_stati_review($ar)
{
	global $config,$db;
	$type=$ar['type'];
	$uid=$ar['conid'];
	$db->query("select count(*) as revis from ".COMMENT." where ctype=$type and conid='$uid'");
	$revs=$db->fetchRow();
	return $revs['revis'];
}
?>