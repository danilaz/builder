<?php
//-----------------------------------------------------------------
include_once($config['webroot'].'/lang/'.$config['language'].'/front/global.php');
$fn=basename($_SERVER['SCRIPT_FILENAME']);
if(file_exists($config['webroot'].'/lang/'.$config['language'].'/front/'.$fn))
	include_once($config['webroot'].'/lang/'.$config['language'].'/front/'.$fn);
if(!empty($_GET['m'])&&!empty($_GET['s']))
	@include('module/'.$_GET['m'].'/lang/'.$config['language'].'/'.$_GET['s'].'.php');
	
if(isset($lang["title"]))
{
	$tpl->assign("guide",isset($lang["guide"])?$lang["guide"]:$lang["title"]);
	$tpl->assign("title",$lang["title"]);
}
if(isset($lang["keyword"]))
	$config["keyword"]=$lang["keyword"];
if(isset($lang["description"]))
	$config["description"]=$lang["description"];
	
$tpl->assign("sname",$fn);
$tpl->assign("lang",$lang);
//-----------------------------------------------------------------
$subsql=NULL;
if(!empty($dpid))
	$subsql=" and con_province='$dpid' and (con_city='' or con_city is NULL) ";
if(!empty($dcid))
	$subsql=" and con_city='$dcid' ";
if(empty($dpid)&&empty($dcid))
	$subsql="and con_province='' and con_city=''";
$sql="select * from ".WEBCON." where con_statu=1 $subsql and lang='$config[language]' order by con_no asc";
$db->query($sql);
$li=array();
while($v=$db->fetchRow())
{
	if(!empty($v['con_linkaddr']))
	{
		if(substr($v['con_linkaddr'],0,4)=='http')
			$url=$v['con_linkaddr'];
		else
			$url=$config['weburl'].'/'.$v['con_linkaddr'];
	}
	else
		$url=$config['weburl']."/aboutus.php?type=".$v['con_id'];
	$li[]="<a href='$url'>".$v['con_title']."</a>";
}
$tpl->assign("web_con",implode(" | ",$li));

if(!empty($config["copyright"]))
{
	$config["copyright"].='<br />Powered by <a href="http://www.b2b-builder.com">'.$config['version'].'</a>';
	$tpl->assign("bt",$config["copyright"]);
}
$tpl->assign("config",$config);
//============================================
if($config['rewrite']>0)
{
	if($config['rewrite']==1)
	{
		$searcharray[] = "/\/\?m=(\w+)&s=(\w+)&id=(\w+)/";
		$searcharray[] = "/\/\?m=(\w+)&s=(\w+)/";
		$searcharray[] = "/\/\?m=(\w+)/";
		$replacearray[] = "/\\1-\\2-\\3.html";
		$replacearray[] = "/\\1-\\2.html";
		$replacearray[] = "/\\1.html";
	}
	else
	{
		$searcharray[] = "/\/\?m=(\w+)&s=(\w+)&id=(\w+)/";
		$searcharray[] = "/\/\?m=(\w+)&s=(\w+)/";
		$searcharray[] = "/\/\?m=(\w+)/";
		$replacearray[] = "/_\\1-\\2-\\3/";
		$replacearray[] = "/_\\1-\\2/";
		$replacearray[] = "/_\\1/";
	}
	function rewrite($output, &$smarty)
	{
		global $searcharray,$replacearray;
		return preg_replace($searcharray, $replacearray, $output);
	}
	$tpl->register_outputfilter("rewrite");
}
if(isset($mlang))
	$tpl->register_outputfilter("translate");
?>