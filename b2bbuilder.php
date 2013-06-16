<?php
/**
 * Email:zyfang1115@163.com
 * Auter:Brad.zhang
 * 2010,7,17
 */
include_once("includes/smarty_config.php");
//========================================
if(!empty($_GET['m']))
{
	$s=!empty($_GET['s'])?$_GET['s']:'index';
	$m=$_GET['m'];
	if(file_exists($config['webroot'].'/module/'.$m.'/'.$s.'.php'))
	{
		@include('module/'.$m.'/lang/'.$config['language'].'/'.$s.'.php');
		include('module/'.$m.'/'.$s.'.php');
	}
	elseif(file_exists($m.'.html'))
		include($m.'.html');
	else
		header("Location: 404.php");
	
	if(!empty($out))
	{	
		$tpl->template_dir=$config['webroot']."/templates/".$config['temp']."/";
		$tpl->assign("out",$out);
		$tpl->caching = false; //设置缓存方式
		$tpl->display("m.htm");
	}
}
else
{
	if(file_exists($config['webroot'].'/config/home_config.php'))
	{
		include($config['webroot'].'/config/home_config.php');
		$tpl->assign("home_config",$home_config);
	}
	include_once("footer.php");//调用页尾
	$tpl->assign("current","home");
	make_html($config['webroot'].'/cache/front/index.htm',$tpl->fetch("b2bbuilder.htm"));
	$tpl->display("b2bbuilder.htm");
	//=====================================
}
?>