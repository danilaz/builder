<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//===========================================
function convertip($ip, $ipdatafile)
{
	static $fp = NULL, $offset = array(), $index = NULL;
	$ipdot = explode('.', $ip);
	$ip    = pack('N', ip2long($ip));
	$ipdot[0] = (int)$ipdot[0];
	$ipdot[1] = (int)$ipdot[1];
	if($fp === NULL && $fp = @fopen($ipdatafile, 'rb')) {
		$offset = unpack('Nlen', fread($fp, 4));
		$index  = fread($fp, $offset['len'] - 4);
	} elseif($fp == FALSE) {
		return  '- Invalid IP data file';
	}
	$length = $offset['len'] - 1028;
	$start  = unpack('Vlen', $index[$ipdot[0] * 4] . $index[$ipdot[0] * 4 + 1] . $index[$ipdot[0] * 4 + 2] . $index[$ipdot[0] * 4 + 3]);

	for ($start = $start['len'] * 8 + 1024; $start < $length; $start += 8) {

		if ($index{$start} . $index{$start + 1} . $index{$start + 2} . $index{$start + 3} >= $ip) {
			$index_offset = unpack('Vlen', $index{$start + 4} . $index{$start + 5} . $index{$start + 6} . "\x0");
			$index_length = unpack('Clen', $index{$start + 7});
			break;
		}
	}
	fseek($fp, $offset['len'] + $index_offset['len'] - 1024);
	if($index_length['len']) {
		return '- '.fread($fp, $index_length['len']);
	} else {
		return '- Unknown';
	}
}

?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<script type="text/javascript">
function show(n)
{
	var d=document.getElementById ("div"+n);
	var a = document.getElementsByTagName("a");
	if(d)
	{
		d.style.display = "block";
		d.style.left = document.documentElement.scrollLeft + a[n].clientX + "px";
		d.style.top  = document.documentElement.scrollTop  + a[n].clientY + "px";
	}
}
function hid(n)
{
	var d=document.getElementById ("div"+n);
	if(d)
	{
		d.style.display = "none";
	}
}
</script>
<body>

<?php
include_once("../includes/arrcache_class.php");
$caches     = new ArrCache('../cache/front');
$cachetime = 600;//数据调用缓存时间。
if(!$caches->begin('pageview',$cachetime))
{
		
	if($config['openstatistics'])
	{
		$sql="select ip,username,count(*) as num from ".PV." group by ip order by num desc, ip asc,username desc limit 10";
		$db->query($sql);
		$ipNum=$db->num_rows();
		$list=$db->getRows();
		
		$sql="select url,count(*) as urlnum from ".PV." group by url order by urlnum desc, url asc limit 10";
		$db->query($sql);
		$urlnum=$db->num_rows();
		$urllist=$db->getRows();
		
		$sql="select count(*) as num from ".PV;
		$db->query($sql);
		$rs=$db->fetchRow();
		$pvs=$rs['num'];//pv总数
		//------------------------------
		$sql="select count(distinct ip) as ips from ".PV;
		$db->query($sql);
		$rs=$db->fetchRow();
		$ips=$rs['ips'];//独立ip总数
		//-----------------------------------
		$sql="select count(url) as urls from ".PV;
		$db->query($sql);
		$rs=$db->fetchRow();
		$urls=$rs['urls'];//url总数
		//-------------------------------------
		$sql="select  url,count(*) as num from ".PV." group by url order by num desc limit 1";
		$db->query($sql);
		$rs=$db->fetchRow();
		$mostpopurl=$rs['url'];//最受欢迎的url
		$urlvisitnum=$rs['num'];//访问次数
		//-----------------------------------
		$sql="select count(distinct username) as users from ".PV." where username<>''";
		$db->query($sql);
		$rs=$db->fetchRow();
		$onusers=$rs['users'];//上线会员数
		//-----------------------------------
		$sql="select count(*) as reguser from ".USER." where TO_DAYS(NOW())-TO_DAYS(regtime)<=1";
		$db->query($sql);
		$rs=$db->fetchRow();
		$nregusers=$rs['reguser'];//新注册会员数
		//-----------------------------------
		$sql="select count(*) as pros from ".PRO." where TO_DAYS(NOW())-TO_DAYS(uptime)<=1";
		$db->query($sql);
		$rs=$db->fetchRow();
		$prods=$rs['pros'];//新发布产品数
		//-------------------------------------
		$sql="select count(*) as offers from ".INFO." where TO_DAYS(NOW())-TO_DAYS(uptime)<=1";
		$db->query($sql);
		$rs=$db->fetchRow();
		$offers=$rs['offers'];//新发布产品数
		//-----------------------------------------
		$sql="select count(*) as newss from ".NEWSD." where TO_DAYS(NOW())-TO_DAYS(uptime)<=1";
		$db->query($sql);
		$rs=$db->fetchRow();
		$newss=$rs['newss'];//新发布资讯数
		//--------------------------------------
		$sql="select count(*) as exhibs from ".EXHIBIT." where TO_DAYS(NOW())-TO_DAYS(addTime)<=1";
		$db->query($sql);
		$rs=$db->fetchRow();
		$exhs=$rs['exhibs'];//新发布展会数
		//------------------------------------
		$sql="select count(*) as videos from ".VIDEO." where TO_DAYS(NOW())-TO_DAYS(time)<=1";
		$db->query($sql);
		$rs=$db->fetchRow();
		$videos=$rs['videos'];//新发布视频数
		//目前游客数
		$nowonline=time()-600;
		$nt=date("Y-m-d H:i:s",$nowonline);
		$sql="select count(distinct ip) as nouss from ".PV." where username='' and time>'$nt' order by time desc";
		$db->query($sql);
		$rs=$db->fetchRow();
		$nousers=$rs['nouss'];//游客数
		//目前在线会员
		$nowonline=time()-600;
		$nt=date("Y-m-d H:i:s",$nowonline);
		$sql="select   * from ".PV." where username<>'' and time>='$nt' group by username order by time desc";
		$db->query($sql);
		$rs=$db->getRows();
	}
	?>
	<link href="main.css" rel="stylesheet" type="text/css" />
	<div class="guidebox"><?php echo lang_show('tsys');?> &raquo; <?php echo lang_show('tts');?></div>
	<div class="bigbox">
	 <div class="bigboxhead"><?php echo lang_show('ttitle');?></div>
	 <div class="bigboxbody">
	 <?php
	 if(!$config['openstatistics'])
	 {
		admin_msg('system_config.php',"Статистика выключена, пожалуйста, включите функцию статистики в настройках системы!");
	 }
	 else
	 {
	 ?>
	   <table width="100%" border="0" cellpadding="1" cellspacing="0">
		 <tr>
		   <td width="138" height="28" align="left"  ><strong><?php echo lang_show('ips');?></strong></td>
		   <td width="304" align="left"  ><?php echo $ips;?></td>
		   <td width="170" height="34" align="left" scope="row" ><strong><?php echo lang_show('pros');?></strong></td>
		   <td width="386" align="left" ><?php echo $prods;?></td>
		 </tr>
		 <tr>
		   <td height="29" align="left" scope="row" ><strong><?php echo lang_show('pvs');?></strong></td>
		   <td align="left" ><?php echo $pvs;?></td>
		   <td height="29" align="left" scope="row" ><strong><?php echo lang_show('offer');?></strong></td>
		   <td align="left" ><?php echo $offers;?></td>
		 </tr>
		 <tr>
		   <td height="29" align="left" scope="row" ><strong><?php echo lang_show('urls');?></strong></td>
		   <td align="left" ><?php echo $urls;?></td>
		   <td height="29" align="left" scope="row" ><strong><?php echo lang_show('exhib');?></strong></td>
		   <td align="left" ><?php echo $exhs;?></td>
		 </tr>
		 <tr>
		   <td height="29" align="left" scope="row" ><strong><?php echo lang_show('murls');?></strong></td>
		   <td align="left" ><?php echo urldecode($mostpopurl);?>:(<?php echo $urlvisitnum;?>)</td>
		   <td height="29" align="left" scope="row" ><strong><?php echo lang_show('newss');?></strong></td>
		   <td align="left" ><?php echo $newss;?></td>
		 </tr>
		 <tr>
		   <td height="29" align="left" scope="row" ><strong><?php echo lang_show('todayreguser');?></strong></td>
		   <td align="left" ><?php echo $nregusers;?></td>
		   <td height="29" align="left" scope="row" ><strong><?php echo lang_show('videos');?></strong></td>
		   <td align="left" ><?php echo $videos;?></td>
		 </tr>
		 <tr>
		   <td height="29" align="left" scope="row" ><strong><?php echo lang_show('todayonlineuser');?></strong></td>
		   <td align="left" ><?php echo $onusers;?></td>
		   <td height="29" align="left" scope="row" >&nbsp;</td>
		   <td align="left" >&nbsp;</td>
		 </tr>
		 <tr>
		   <td height="29" align="left" scope="row" ><strong><?php echo lang_show('onlinevs');?></strong></td>
		   <td colspan="3" align="left" ><?php echo $nousers;?></td>
	     </tr>
		 <tr>
		   <td height="29" align="left" scope="row" ><strong><?php echo lang_show('nowonlineu');?></strong></td>
		   <td colspan="3" align="left" >
		   <?php 
		   foreach($rs as $key=>$u)
		   {
			  echo "<a href='#' title='$u[url]' >".$u['username']."</a>&nbsp;&nbsp;";
			  if(($key+1)%10==0)
				echo '<br>';
		   }
		   ?>
			 &nbsp;</td>
		  </tr>
	   </table>
	  </div>
	</div>
	<div style="float:left; height:20px; width:80%;">&nbsp;</div>
	<div class="bigbox">
	 <div class="bigboxhead"><?php echo lang_show('ipnot');?></div>
	<div class="bigboxbody">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <tr>
		<td width="287" height="22"><?php echo lang_show('ip');?></td>
		<td width="334"><?php echo lang_show('user');?></td>
		<td width="192"><?php echo lang_show('view_count');?></td>
		<td width="193">Операция</td>
	  </tr>
	<?php
	if(is_array($list))
	{
	foreach($list as $value)
	{
	?>
	  <tr>
		<td ><?php echo $value['ip']; echo '['.convertip($value['ip'], '../lib/tinyipdata.dat').']';?></td>
		<td ><?php echo $value['username']; ?>&nbsp;</td>
		<td ><?php echo $value['num']; ?></td>
		<td ><a href="iplockset.php?ip=<?php echo $value['ip'];?>">Блокировать IP</a></td>
	  </tr>
	<?php
	}}
	?>
	</table>
	</div>
	</div>
	<div style="float:left; height:20px; width:80%;">&nbsp;</div>
	<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('urlnot');?></div>
	<div class="bigboxbody">
	<table width="100%" cellpadding="0" cellspacing="0">
	  <tr>
		<td width="565" >URL</td>
		<td width="132"><?php echo lang_show('view_count');?></td>
		</tr>
	<?php
		if(is_array($urllist))
		{
			foreach($urllist as $value)
			{
				?>
				  <tr>
					<td><?php echo urldecode($value['url']); ?></td>
					<td><?php echo $value['urlnum']; ?></td>
					</tr>
				<?php
			 }
		 }
	 }
	?>
	</table>
	</div>
	</div>
	<?php 
}
$caches->end();
?>
</body>
</html>