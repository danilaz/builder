<?php
/*
 * Auther:Brad zhang
 * Date:2009-3-2
 */
//===========================================
useCahe();
$flag=md5($dpid.$dcid.$config["temp"].$_COOKIE["langtw"].$_GET['id']);
if(!$tpl->is_cached("exhibition_detail.htm",$flag))
{	include_once($config['webroot']."/includes/tag_inc.php");
	//======================================
	$sql="select * from ".EXHIBIT." where id='$_GET[id]'";
	$db->query($sql);
	$re=$db->fetchRow();
	$tpl->assign("de",$re);
	
	$config["description"] = csubstr(strip_tags($re['con']),0,100);
	$config["keyword"] = get_tags($_GET['id'],4);
	$tpl->assign("title",$re['title']);
	$tpl->assign("current","exhibition");
	//===========================================
	include_once("footer.php");
}
$out=tplfetch("exhibition_detail.htm",$flag);
?>