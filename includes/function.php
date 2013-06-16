<?php
/**
 * Copright :上海远丰信息科支有限公司
 * Powered by :b2bbuilder
 * Auter:brad
 * Date: 2011-02-24
 * Des:非公共免费代码，没有得到许可，禁止传播，复制。
 */
//===================
function ext_all($functionname,$array)
{
	global $config;
	$dir=$config['webroot'].'/module/';
	$handle = opendir($dir); 
	while ($filename = readdir($handle))
	{ 
		if($filename!="."&&$filename!="..")
		{
			if(file_exists($dir.$filename.'/api.php'))
			{	 
				include($dir.$filename."/api.php");
				$className=$filename.'_api';
				$api=new $className();
				if(method_exists($api,$functionname))
				{
					$api->$functionname($array);
					$re[$filename]=$api->result;
				}
			}
		}
	}
	return $re;
}
function translate($output, &$smarty)
{
	global $mlang;
	preg_match_all("/[\x{4e00}-\x{9fa5}]+/u", $output, $match);
	$ch=array_unique($match[0]);
	$keys="2F5BDF05493BA142E3666C51BF0C764B5B866318";
	if(count($ch))
	{
		foreach($ch as $key=>$v)
		{	$i++;
			//if($i>100)
				//unset($ch[$key]);
		}
		foreach($ch as $key=>$v)
		{
			if(isset($tch[strlen($v)]))
				$tch[strlen($v).'.'.$key]=$v;
			else
				$tch[strlen($v)]=$v;
		}
		unset($ch);
		krsort($tch);
		$en=implode("<br>",$tch);
		$en=urlencode($en);
		$url="http://api.microsofttranslator.com/v2/Http.svc/Translate?appId=$keys&text=$en&from=zh-cn&to=$mlang";
		$r=file_get_contents($url);
		$r=strip_tags($r);
		$en=explode("&lt;br&gt;",$r);
		return str_replace($tch,$en,$output);
	}
	else
		return $output;
	
}
function geturl($type,$uid,$user,$tid=NULL,$com=NULL,$m=NULL)
{
	//smarty 调用方试为<{geturl type='' uid='' user='' tid=''}>,如果是公司商铺首页调用type=NULL
	//$config['rewrite'] 备用判断,现在为空值，以后增加此变量可以实现无地址重写也可以使用网站.

	global $config,$company;
	if($config['opensuburl']&&empty($type))
		$url="http://".$user.".".$config['baseurl'];
	else
		$url=$config['weburl'];
	if(!empty($m)&&$company['open_info_type']==1)
		$tid=$tid."&m=$m";
		
	if(empty($type))
	{
		return $config['weburl'].'/shop.php?uid='.$uid;
	}
	else
	{
		if($type=='prod'&&empty($company['open_info_type']))
			return $config['weburl']."/?m=product&s=product_detail&id=$tid";
		if($type=='offer_detail'&&empty($company['open_info_type']))
			return $config['weburl']."/?m=offer&s=offer_detail&id=$tid";
		if($type=='demand_detail'&&empty($company['open_info_type']))
			return $config['weburl']."/?m=demand&s=demand_detail&id=$tid"; 
		else
			return $config['weburl']."/shop.php?uid=$uid&action=$type&id=$tid";
	}

	
}
function make_html($file_name, $content) 
{     	 
	 if(!$fp = fopen($file_name, "w+")){ 
		 return false; 
	 } 
	 if(!fwrite($fp, $content)){ 
		 fclose($fp); 
		 return false; 
	 }
	 fclose($fp);
		 @chmod($file_name,0666);
 }
function renew_point($type='',$point='',$users=NULL)
{
	global $db,$buid;
	if($point=='0')
		return false;
	else
	{
		if($type=='reg')
		{
			 $sql="update ".USER." set point=$point where userid='$users'";
			 $db->query($sql);
			 return true;
		}
		else
		{
			if($point<0)
			{
				$sql="select point from ".USER." where userid='$buid'";
				$db->query($sql);
				$npoint=$db->fetchField('point');
				if($npoint+$point<0)
					$point=0;
			}
			$sql="update ".USER." set point=point+$point where userid='$buid'";
			$db->query($sql);
			return true;
		}
	}
}
function convert($array)
{
	if(is_array($array))
	{
		 @array_walk($array, create_function('&$value, $key', '$value = $key ."=". $value;'));
	}
	return $array;
}
function msg($url,$str="")
{
	if($url&&!$str)
		echo "<script>window.location='$url';</script>";
	if($url&&$str)
		echo "<script>alert('$str');window.location='$url';</script>";
	die;
}
function dateformat($time)
{
	global $config;
	if(!empty($config['date_format']))
		$config['date_format']=str_replace("%",'',$config['date_format']);
	if(is_numeric($time))
		return date($config['date_format'],$time);
	else
		return date($config['date_format'],strtotime($time));
}
function get_userdir($uid)
{
	global $config,$db;
	
	if(is_numeric($uid))
		$sql="select regtime,userid from ".USER." WHERE userid='$uid'";
	else
		$sql="select regtime,userid from ".USER." WHERE user='$uid'";
	$db ->query($sql);
	$ut=$db->fetchRow();
	if(empty($ut['regtime']))
	{
		$ut['regtime']=date("d-m-Y H:i:s");
		$db->query("update ".USER." SET regtime='".$ut['regtime']."' where userid='".$ut['userid']."'");
	}

	$ar=explode('-',$ut['regtime']);
	$rdir=$ar[0].'/'.$ar[1].'/'.$ut['userid'];
	$dir=$config['webroot'].'/cache/shop/'.$rdir; 
	mkdirs($dir);
	return $rdir;
}
function mkdirs($dir)
{    
	return is_dir($dir) or (mkdirs(dirname($dir)) and mkdir($dir, 0777));
}

function authcode($string, $operation = 'DECODE', $expiry = 0)
{
	global $config;
	$ckey_length = 4;
	$key = md5(md5($config['authkey'].$_SERVER['HTTP_USER_AGENT']));
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);

	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);

	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}

	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}

}
function bsetcookie($var,$value,$time=NULL,$path=NULL,$dommain)
{
	global $config;
	$value=authcode($value,'ENDODE');
	setcookie($config['language'].$var,$value,$time,$path,$dommain);
}
function bgetcookie($var)
{
	global $config;
	$nvar=$config['language'].$var;
	if(isset($_COOKIE[$nvar]))
		return explode("\t", authcode($_COOKIE[$nvar], 'DECODE')) ;
	elseif(isset($_COOKIE['cn'.$var]))
		return explode("\t", authcode($_COOKIE['cn'.$var], 'DECODE')) ;
	elseif(isset($_COOKIE['en'.$var]))
		return explode("\t", authcode($_COOKIE['en'.$var], 'DECODE')) ;
}
function lang_show ($langKey, $argument = null)
{
	global $lang;
	if(empty($lang[$langKey])||!$showContent = $lang[$langKey])
	    return false;
	
	if($argument)
	{
	    while (list($key,$item) = @each($argument))
	    {
			$showContent = str_replace('#'.$key, $item, $showContent);
	    }
	}
	return $showContent;
}
function inject_check($sql)
{ 
	return preg_match("/^select|insert|delete|\.\.\/|\.\/|union|into|load_file|outfile/", $sql);// 进行过滤   
}
function magic()
{
	if(!get_magic_quotes_gpc()&&isset($_POST))
	{
		foreach($_POST as $key=>$v)
		{
			if(!is_array($v))
				$_POST[$key]=addslashes($v);
		}
	}
	//===========GET
	if(inject_check($_SERVER["REQUEST_URI"]))
	{
		die('Invalid URL !');
	}
	//===========POST
	if(isset($_POST))
	{
		foreach($_POST as $key=>$v)
		{
			if(!is_array($v))
			{
				if(strpos($v,'eval')or(strpos($v,'$_POST[')))
					die('Invalid POST');
			}
		}
	}
}
function get_comcat()
{
	global $db;
	$db->query("SELECT * FROM ".COMPANYCAT." WHERE catid<=9999 ORDER BY catid ASC");
	return $db->getRows();
}

function stop_ip($ip)
{
	if(is_array($ip))
	{
		foreach($ip as $v)
		{	
			if($uip=getip())
			{	
				$pos = strpos($uip,str_replace(".*","",$v));
				if($pos===false)
					;
				else
					die("Ваш IP был заблокирован!");
			}
			else
				die;
		}
	}
}
//获取国家列表
function country_list()
{
	global $db,$config;
	if($config['language']=='cn')
		$sql="select id,cname as name from ".COUNTRY." where cname!='' order by nums asc,ename asc";
	else
		$sql="select id,ename as name from ".COUNTRY." where ename!='' order by nums asc,ename asc";
	$db->query($sql);
	return $db->getRows();
}
function tohtml($ar,$ar1)
{
	foreach($ar as $key=>$v)
	{
		if(!in_array($key,$ar1))
			$ar[$key]=htmlspecialchars($v);
	}
	return $ar;
}
//验证函数结束
function isrobot() 
{
	if(!defined('IS_ROBOT'))
	{
		$kw_spiders = 'Bot|Crawl|Spider|slurp|sohu-search|lycos|robozilla';
		$kw_browsers = 'MSIE|Netscape|Opera|Konqueror|Mozilla';
		if(!strexists($_SERVER['HTTP_USER_AGENT'], 'http://') && preg_match("/($kw_browsers)/i", $_SERVER['HTTP_USER_AGENT'])) {
			define('IS_ROBOT', FALSE);
		} elseif(preg_match("/($kw_spiders)/i", $_SERVER['HTTP_USER_AGENT'])) {
			define('IS_ROBOT', TRUE);
		} else {
			define('IS_ROBOT', FALSE);
		}
	}
	return IS_ROBOT;
}
function strexists($haystack, $needle)
{
	return !(strpos($haystack, $needle) === FALSE);
}
function add_page_view()
{
	if(!isrobot())
	{
		global $db;
		$user=empty($_COOKIE['USER'])?NULL:$_COOKIE['USER'];
		$time=date("Y-m-d H:i:s");
		$ip=getip();
		$sql="insert into ".PV."
		(url,ip,time,username,fileName)
		values
		('".substr(urlencode($_SERVER['REQUEST_URI']),0,30)."','$ip','$time','$user','".substr($_SERVER['SCRIPT_NAME'],0,30)."')";
		$db->query($sql);
	}
}
function getip()
{
	if (isset($_SERVER)) {
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	   $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
	   $realip = $_SERVER['HTTP_CLIENT_IP'];
	} else {
	   $realip = $_SERVER['REMOTE_ADDR'];
	}
	} else {
	if (getenv("HTTP_X_FORWARDED_FOR")) {
	   $realip = getenv( "HTTP_X_FORWARDED_FOR");
	} elseif (getenv("HTTP_CLIENT_IP")) {
	   $realip = getenv("HTTP_CLIENT_IP");
	} else {
	   $realip = getenv("REMOTE_ADDR");
	}
	}
	return $realip;
}
function bd_file_exists($url_file)
{
	//检测输入
	global $config;
	if($config['openimgserv'])
	{
		$url_file = trim($url_file);
		$url_arr = parse_url($url_file);
		if (!is_array($url_arr) || empty($url_arr)){ return false; }
		//获取请求数据
		$host = $url_arr['host'];
		$path = $url_arr['path'] ."?". $url_arr['query'];
		$port = isset($url_arr['port']) ? $url_arr['port'] : "80";
		//连接服务器
		$fp = fsockopen($host, $port, $err_no, $err_str, 30);
		if (!$fp){ return false; }
		//构造请求协议
		$request_str = "GET ".$path." HTTP/1.1\r\n";
		$request_str .= "Host: ".$host."\r\n";
		$request_str .= "Connection: Close\r\n\r\n";
		//发送请求
		fwrite($fp, $request_str);
		$first_header = fgets($fp, 1024);
		fclose($fp);
		//判断文件是否存在
		if (trim($first_header) == ""){ return false; }
		if (!preg_match("/200/", $first_header))
		{
			return false;
		}
		return true;
	}
	else
		return file_exists($url_file);
}
function get_province($on=NULL)
{
	global $db;
	$sql="select province_id,province from ".PROVINCE." order by sx asc";
	$db->query($sql);
	$re=$db->getRows();
	$str=NULL;
	foreach($re as $v)
	{
		if($on==$v['province'])
			$sl='selected="selected"';
		else
			$sl='';
		$str.='<option value="'.$v['province'].'" '.$sl.'>'.$v['province'].'</option>';
	}
	return $str;
}
function getCity()
{
	global $db;
	$sql="select province_id,province from ".PROVINCE." order by sx asc";
	$db->query($sql);
	$re=$db->getRows();
	foreach($re as $key=>$v)
	{
		$sql="select city_id,city from ".CITY." WHERE province_id='$v[province_id]'";
		$db->query($sql);
		$re[$key]["city"]=$db->getRows();
	}
	return $re;
}
function makethumb($srcFile,$dstFile,$dstW,$dstH)
{ 
	global $config;
	include_once("$config[webroot]/includes/image_class.php");
	$t=new cls_image();
	$t-> make_thumb($srcFile, $dstFile,$dstW,$dstH);
	unset($t);
}
function csubstr($string, $start, $length, $dot = ' ...')
{   
	if(strlen($string) <= $length) {
		return $string;
	}
	$string = str_replace(array('&nbsp;','&amp;', '&quot;', '&lt;', '&gt;'), array(' ','&', '"', '<', '>'), $string);
	$strcut = '';
		$n = $tn = $noc = 0;
		while($n < strlen($string)) {
			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1; $n++; $noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif(224 <= $t && $t <= 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}
			if($noc >= $length) {
				break;
			}
		}
		if($noc > $length) {
			$n -= $tn;
		}
		$strcut = substr($string, 0, $n);
	return $strcut;
}
##########################################
function useCahe($cachPath=NULL,$lifetime=NULL)
{
	global $tpl,$config;
	if(!empty($config['cacheTime']))
	{
		if(!empty($_GET['m']))
		{
			//如果是 module下面调用，需要事先更改模板路径。
			$dir=$config['webroot'].'/module/'.$_GET['m'].'/templates/'.$config['temp'].'/';
			if(file_exists($dir.$file))
				$tpl->template_dir=$dir;
			else
				$tpl->template_dir=$config['webroot'].'/module/'.$_GET['m'].'/templates/default/';
		}
		
		$tpl->caching = true; //设置缓存方式 
		
		if(!empty($cachPath))
			$tpl->cache_dir = $config['webroot'].'/cache/'.$cachPath;
		else
			$tpl->cache_dir = $config['webroot'].'/cache/front/';
		
		if($lifetime==true)
			$tpl->cache_lifetime = -1 ; //永久有效
		elseif(!is_null($lifetime))
			$tpl->cache_lifetime = $lifetime ; //设置缓存时间
		else
			$tpl->cache_lifetime = $config['cacheTime'] ; //设置缓存时间
	}
}
//----------------------------------------
function readsubcat($id,$cattype=NULL,$isall=NULL)
{	
	global $db;
	if(empty($isall))
		$ssql=" and isindex='1' ";
	else
		$ssql=NULL;
	if(empty($cattype))
	{
		$s=$id."00";
		$b=$id."99";
		$sql="select * from ".PCAT." 
		where 1 $ssql and catid>$s and catid<$b order by nums asc,char_index asc";
	}
	else if($cattype == 'album')
	{
		$s=$id."00";
		$b=$id."99";
		$sql="select * from ".ALBUMCAT." 
		where 1 $ssql and catid>$s and catid<$b order by nums asc,char_index asc";
	}
	else
	{
		if(!empty($id))
		{
			$s=$id."00";
			$b=$id."99";
			$ssql.=" and catid>$s and catid<$b ";
		}
		else
		{
			$ssql.=" and catid<9999 ";
		}
		$sql="select * from ".OCAT." where 1 $ssql order by nums asc,char_index asc";
	}
	$db->query($sql);
	return $db->getRows();
}
function readCat($id,$cattype=NULL)
{
	if($id) 
	{
		global $db;
		if(!empty($cattype))
			$db->query("select * from ".OCAT." where catid=$id order by nums asc,char_index asc");
		else
			$db->query("select * from ".PCAT." where catid=$id order by nums asc,char_index asc");
		
		$re=$db->fetchRow();
		if($id>9999)
		{
			$catid=substr($id,0,strlen($id)-2);
			if(!empty($cattype))
				$sql="select * from ".OCAT." where catid=$catid order by nums asc,char_index asc";
			else
				$sql="select * from ".PCAT." where catid=$catid order by nums asc,char_index asc";
			$db->query($sql);
			$re['pcat']=$db->fetchRow();
		}
		return $re;
	}
}
function send_mail($email,$name,$title,$con,$from=NULL)
{	
	global $config;
	include($config['webroot'].'/config/mail_config.php');
	if($mail_config['mail_statu']==0)
		return NULL;
	else
	{
		if(!empty($mail_config["smtp"]))
		{	
			include_once($config['webroot']."/lib/phpmailer/class.phpmailer.php");
			$mail = new PHPMailer();
			$mail->IsSMTP();                        
			$mail->Host = $mail_config["smtp"];  	
			$sm=explode(":",$mail_config["smtp"]);
			if(count($sm)>=2)
				$mail->Port = $sm[1];  	   
			$mail->SMTPAuth = true;                
			$mail->Username = $mail_config["email"];               
			$mail->Password = $mail_config["emailPass"];          
			$mail->From = !empty($from)?$from:$mail_config["email"];                 
			$mail->FromName=$config['company']; 
			$mail->AddReplyTo=$from;//回复地址
			$mail->WordWrap = 50;           
			$mail->AddAddress($email,$name);
			$mail->IsHTML(true);                
			$mail->CharSet="utf-8";
			$mail->Subject =$title; 
			$mail->Body =$con;
			$re=$mail->send();
			return $re;
		}
		else
		{
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
			$headers .= 'From: '.$from.'<'.$config['company'].'>' . "\r\n";
			return mail($email,$title,$con,$headers);
		}
	}
}

function tplfetch($file,$flag=NULL,$no_return=false)
{
	global $tpl,$config;
	if(file_exists($tpl->template_dir.$file))
		;
	elseif(file_exists($config['webroot'].'/module/'.$_GET['m'].'/templates/'.$config['temp'].'/'.$file))
		$tpl->template_dir=$config['webroot'].'/module/'.$_GET['m'].'/templates/'.$config['temp'].'/';
	elseif($config['language']=='en'&&file_exists($config['webroot'].'/module/'.$_GET['m'].'/templates/en/'.$file))
		$tpl->template_dir=$config['webroot'].'/module/'.$_GET['m'].'/templates/en/';
	else
		$tpl->template_dir=$config['webroot'].'/module/'.$_GET['m'].'/templates/default/';
	if($no_return)
	{
		$tpl->display($file,$flag);die;
	}
	else
		return $tpl->fetch($file,$flag);
}

function get_mail_template($flag)
{
	global $db;
	$sql="select subject,message from ".MAILMOD." where flag='$flag'";
	$db->query($sql);
	return $db->fetchRow();
}
function  replace_outside_link($str)
{
   $str=preg_replace("/<a.*>|<\/a>/isU",'',$str);
   return $str;
}

//添加统计,$catid为更新的类别id，$actiontype为add增加，del为减少,$cattype为产品还是,分别为pro,offer,com
function update_cat_nums($catid="",$actiontype="",$cattype="")
{
	global $db,$config;
	if(!empty($catid)&&is_numeric($catid))
	{
		if($actiontype=='add')
			$ssql='rec_nums=rec_nums+1';
		elseif($actiontype=='del')
			$ssql='rec_nums=rec_nums-1';
		switch(strlen($catid))
		{
			case '4':
			{
				if($cattype=='pro')
					$sql="update ".PCAT." set ".$ssql." where catid='$catid'";
				elseif($cattype=='offer')
					$sql="update ".OCAT." set ".$ssql." where catid='$catid'";
				elseif($cattype=='demand')
					$sql="update ".OCAT." set ".$ssql." where catid='$catid'"; 
				elseif($cattype=='com')
					$sql="update ".COMPANYCAT." set ".$ssql." where catid='$catid'";
				$db->query($sql);
				break;
			}
			case '6':
			{
				if($cattype=='pro')
					$sql="update ".PCAT." set ".$ssql." where catid='$catid'";
				elseif($cattype=='offer')
					$sql="update ".OCAT." set ".$ssql." where catid='$catid'";
				elseif($cattype=='demand')
					$sql="update ".OCAT." set ".$ssql." where catid='$catid'"; 
				elseif($cattype=='com')
					$sql="update ".COMPANYCAT." set ".$ssql." where catid='$catid'";
				$db->query($sql);
				$catid=substr($catid,0,4);
				if($cattype=='pro')
					$sql="update ".PCAT." set ".$ssql." where catid='$catid'";
				elseif($cattype=='offer')
					$sql="update ".OCAT." set ".$ssql." where catid='$catid'";
				elseif($cattype=='demand')
					$sql="update ".OCAT." set ".$ssql." where catid='$catid'"; 
				elseif($cattype=='com')
					$sql="update ".COMPANYCAT." set ".$ssql." where catid='$catid'";
				$db->query($sql);
				break;
			}
			case '8':
			{
				if($cattype=='pro')
					$sql="update ".PCAT." set ".$ssql." where catid='$catid'";
				elseif($cattype=='offer')
					$sql="update ".OCAT." set ".$ssql." where catid='$catid'";
				elseif($cattype=='demand')
					$sql="update ".OCAT." set ".$ssql." where catid='$catid'"; 
				elseif($cattype=='com')
					$sql="update ".COMPANYCAT." set ".$ssql." where catid='$catid'";
				$db->query($sql);
				$catid=substr($catid,0,6);
				if($cattype=='pro')
					$sql="update ".PCAT." set ".$ssql." where catid='$catid'";
				elseif($cattype=='offer')
					$sql="update ".OCAT." set ".$ssql." where catid='$catid'";
				elseif($cattype=='demand')
					$sql="update ".OCAT." set ".$ssql." where catid='$catid'"; 
				elseif($cattype=='com')
					$sql="update ".COMPANYCAT." set ".$ssql." where catid='$catid'";
				$db->query($sql);
				$catid=substr($catid,0,4);
				if($cattype=='pro')
					$sql="update ".PCAT." set ".$ssql." where catid='$catid'";
				elseif($cattype=='offer')
					$sql="update ".OCAT." set ".$ssql." where catid='$catid'";
				elseif($cattype=='demand')
					$sql="update ".OCAT." set ".$ssql." where catid='$catid'"; 
				elseif($cattype=='com')
					$sql="update ".COMPANYCAT." set ".$ssql." where catid='$catid'";
				$db->query($sql);
				break;
			}
		}
	}
}

function readauditing($id,$cat)
{
	global $db;
	$sql="select argument from ".AUDIT." where itemtype='$cat' and itemid='$id' order by uptime desc";
	$db->query($sql);
	return $db->fetchField("argument");
}
function admin_msg($url,$str=NULL)
{
	msg('noright.php?str='.urlencode($str).'&url='.urlencode($url));
}
?>