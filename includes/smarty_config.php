<?php
include_once($config["webroot"]."/includes/insert_function.php");
include_once($config["webroot"]."/lib/smarty/Smarty.class.php");
include_once($config["webroot"]."/config/nav_menu.php");
include_once($config['webroot']."/config/stop_ip.php");
include_once($config['webroot']."/config/cron_config.php");
include_once($config['webroot']."/includes/arrcache_class.php");
include_once($config['webroot']."/config/seo_config.php");
//==================================================
if(!empty($config['enable_gzip']) && function_exists('ob_gzhandler'))
	ob_start('ob_gzhandler');
//=================================================
$b2bbuilder_auth=bgetcookie("USERID");
$buid=$b2bbuilder_auth['0'];
if(!empty($cron_config['nexttransact'])&&$cron_config['nexttransact']<=time())
{
	$systime=time();
	include_once($config['webroot']."/includes/cron_inc.php");
	execute_transact();
}
//==================================================
if(isset($config['closetype'])&&$config['closetype']=='1')
{
$closesitesText = $config['closecon'];
$closesites=<<<HTML1
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>B2Bbuilder- Support by Chinascript.ru</title>
<meta name="description" content="B2Bbuilder" />
<meta name="keywords" content="B2Bbuilder" />
</head>

<body>


<STYLE type=text/css>
div.w60
{
	width: 60%;
	margin: 0 auto;
	margin-top:150px;
	text-align:center;
}	

	div.box-c
	{
		height:20px;
		margin: 0 20px;
		position: relative;
		background: #C32300;
	}
	
		div.box-c em b 
		{
		   position:absolute;
		   font:150px Arial;
		   line-height:40px;
		   font-weight:normal;
		}
		
		.ctl, .cbl, .ctr, .cbr 
		{
		   z-index:11;
		   width:20px;
		   height:20px;
		   color:#C32300;	 
		   overflow:hidden;
		   position:absolute;  
		   background:transparent;
		   
		}
		
		.ctl {top:0; left:-20px;}
		.cbl {bottom:0; left:-20px;}
		.ctr {top:0; right:-20px;}
		.cbr {bottom:0; right:-20px;}

		.ctl b {left:-8px;}
		.ctr b {left:-25px;}
		.cbl b {left:-8px; top:-17px;}
		.cbr b {left:-25px; top:-17px;}
		
	div.box-inner
	{
		padding: 0 20px;
		background: #C32300;
		color:#FFFFFF;
	}
</STYLE>

<div class="box w60">
            <div class="box-c">
                <em class="ctl"><b>&bull;</b></em>
                <em class="ctr"><b>&bull;</b></em>
            </div>            
            <div class="box-inner">
              $closesitesText
            </div>
			<div class="box-c">
                <em class="cbl"><b>&bull;</b></em>
                <em class="cbr"><b>&bull;</b></em>
            </div>
        </div>
</body>
</html>
HTML1;
echo $closesites;
	die;
}
//------------------------------------------------
if($buid)
{
	session_start();
	if(isset($_SESSION["IFPAY"])&&$_SESSION["IFPAY"]==-2)
	{
$bansites=<<<HTML1
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>B2Bbuilder- Support by Chinascript.ru</title>
<meta name="description" content="B2Bbuilder" />
<meta name="keywords" content="B2Bbuilder" />
</head>

<body>


<STYLE type=text/css>
div.w60
{
	width: 60%;
	margin: 0 auto;
	margin-top:150px;
}	

	div.box-c
	{
		height:20px;
		margin: 0 20px;
		position: relative;
		background: #C32300;
	}
	
		div.box-c em b 
		{
		   position:absolute;
		   font:150px Arial;
		   line-height:40px;
		   font-weight:normal;
		}
		
		.ctl, .cbl, .ctr, .cbr 
		{
		   z-index:11;
		   width:20px;
		   height:20px;
		   color:#C32300;	 
		   overflow:hidden;
		   position:absolute;  
		   background:transparent;
		   
		}
		
		.ctl {top:0; left:-20px;}
		.cbl {bottom:0; left:-20px;}
		.ctr {top:0; right:-20px;}
		.cbr {bottom:0; right:-20px;}

		.ctl b {left:-8px;}
		.ctr b {left:-25px;}
		.cbl b {left:-8px; top:-17px;}
		.cbr b {left:-25px; top:-17px;}
		
	div.box-inner
	{
		padding: 0 20px;
		background: #C32300;
		color:#FFFFFF;
	}
</STYLE>

<div class="box w60">
            <div class="box-c">
                <em class="ctl"><b>&bull;</b></em>
                <em class="ctr"><b>&bull;</b></em>
            </div>            
            <div class="box-inner">
              Извините, но Ваш аккаунт заблокирован!
            </div>
			<div class="box-c">
                <em class="cbl"><b>&bull;</b></em>
                <em class="cbr"><b>&bull;</b></em>
            </div>
        </div>
</body>
</html>
HTML1;
echo $bansites;
	die;
	}
}
//----------------------------------------------
stop_ip($stop_view);
unset($stop_view);
//-------------------------------------------------
if($config['domaincity']&&!empty($config['baseurl']))
{
	$dre=explode(".",$_SERVER['HTTP_HOST']);
	$prefix=array_shift($dre);
	if($_SERVER['HTTP_HOST']==$prefix.'.'.$config['baseurl']&&!isset($_GET['uid']))
	{
		$sql="select con,con2,web_title,web_keyword,web_des,des,copyright,template from ".DOMAIN." where domain='".$prefix."'";
		$db->query($sql);
		$do=$db->fetchRow();
		if(is_array($do))
		{
			$config['title']  		= 	$do['web_title'];
			$config['keyword']		= 	$do['web_keyword'];
			$config['description']	= 	$do['web_des'];
			$config['company']  	= 	$do['web_title'];
			$config['copyright']	=	$do['copyright'];
			$config['site_des']		= 	$do['des'];
			$config['logo']			=	$do['logo'];
			if(!empty($do['template']))
				$config['temp']		=	$do['template'];
			setcookie("SPID",$do['con'],time()+60*60*24*30,'/');
			setcookie("SCID",$do['con2'],time()+60*60*24*30,'/');
			$dpid=!empty($do['con'])?$do['con']:'';
			$dcid=!empty($do['con2'])?$do['con2']:'';
			$config['weburl']="http://".$prefix.".".$config['baseurl'];
		}
	}
	unset($dre);unset($do);unset($exception);
	$mcountry=array('de','fr','en','ja','kr');
	if(in_array($prefix,$mcountry))
	{
		$mlang=$prefix;
		$config['weburl']="http://".$mlang.".".$config['baseurl'];
	}
}
//------------------------------------------
//如果选译了城市，或者开启了二级域名，并且二级域名存在
if(!empty($_COOKIE['PID'])&&empty($dpid))
	$dpid=$_COOKIE['PID'];
if(!empty($_COOKIE['CID'])&&empty($dcid))
	$dcid=$_COOKIE['CID'];
//-----------------------------------------
//搜索词入库
if(!empty($_GET['key']))
{
	$db->query("select id from ".SWORD." where keyword='$_GET[key]'");
	if($db->fetchField('id'))
		$sql="update ".SWORD." set nums=nums+1 where keyword='$_GET[key]'";
	else
	{
		include_once('lib/allchar.php');
		$str=addslashes(c($_GET['key']));
		$sql="insert into ".SWORD." (keyword,char_index,nums) values ('$_GET[key]','$str','1')";
	}
	$db->query($sql);
}
//--------------------------------------
if($config['openstatistics'])
	add_page_view();// 统计调用.
//-------------------------------------------------------
if(!empty($_GET["tw"])&&$_GET["tw"]=="true")
	setcookie("langtw","tw",time()+60*60*24*30,'/');
else
	$_COOKIE['langtw']=NULL;
	
if(!empty($_GET["temp"]))
{
	setcookie("temp",$_GET["temp"]);
	msg($config['weburl']);
}
if(!empty($_COOKIE['temp']))
	$config['temp']=$_COOKIE['temp'];
//-------------------------------------------------------
$tpl =  new Smarty();
$tpl -> left_delimiter  = "<{";
$tpl -> right_delimiter = "}>";
$tpl -> template_dir    = $config["webroot"] . "/templates/".$config['temp']."/";

if(isset($_COOKIE["langtw"]))
	$tpl -> compile_dir     = $config["webroot"] . "/templates_c/".$config['temp']."_tw/";
else
	$tpl -> compile_dir     = $config["webroot"] . "/templates_c/".$config['temp']."/";

$tpl -> assign("buid",$buid);
$tpl -> assign("menus",$nav_menu);
unset($nav_menu);
?>