<?php
/**
 * Copright :http://www.b2b-buildr.com
 * Powered by :B2Bbuilder
 */
include_once("includes/news_function.php");
include_once("module/news/lang/".$config['language']."/index.php");
//========================================
useCahe();
$flag=md5($dpid.$dcid.$config["temp"].$_COOKIE["langtw"]);
if(!$tpl->is_cached("news_index.htm",$flag))
{
	$sql="SELECT * from ".NEWSCAT." WHERE ishome=1 and pid=0 order by nums asc";//菜单
	$db->query($sql);
	$re=$db->getRows();
	$tpl->assign("news_menu",$re);
}
//==================================
include_once("footer.php");
$tpl->assign("current","news");
$out=tplfetch("news_index.htm",$flag);
?>