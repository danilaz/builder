<?php
include_once("../includes/global.php"); 
include_once("../includes/page_utf_class.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//====================================
if(!empty($_POST['addlockip'])||!empty($_GET['ip']))
{
	$locktime=0;$maddip=NULL;$autore=0;$otime=time();
	if(!empty($_POST['addlockip']))
		$maddip=$_POST['addlockip'];
	if(!empty($_GET['ip']))
		$maddip=$_GET['ip'];
		
	if(!empty($_POST['locktime']))
		$locktime=strtotime($_POST['locktime']);
	else
		$locktime=time()+3600*24*365;
		
	$type=empty($_POST['type'])?1:$_POST['type'];
	
	$sql="select id from ".IPLOCK." where ip='$maddip'";
	$db->query($sql);
	if(!$db->fetchField('id'))
	{
		$sql="insert into ".IPLOCK." 
		(ip,reason,optime,stoptime,autorelease,statu,type)
		VALUES
		('$maddip','".$_SESSION["ADMIN_USER"]."','$otime','$locktime','1','1','$type')"; 
		$db->query($sql);
	}
	getipdata();
	msg('iplockset.php');
}
//-------------------
if(!empty($_GET['action'])&&$_GET['action']=="release"&&!empty($_GET['lockid']))
{
	$sql="update ".IPLOCK." set statu=0,stoptime='".time()."',optime='".time()."' where id=".$_GET['lockid']; 
	$db->query($sql);
	getipdata();
}
if(!empty($_GET['action'])&&$_GET['action']=="lock"&&!empty($_GET['lockid']))
{
	$sql="update ".IPLOCK." set statu=1,stoptime='".(time()+3600*24*365)."',optime='".time()."' where id=".$_GET['lockid']; 
	$db->query($sql);
	getipdata();
}
//---------------------
if(!empty($_GET['releaseall'])&&empty($_GET['action']))
{
	if(is_array($_GET['checkip']))
	{
		$delid=implode(",",$_GET['checkip']);
		$sql="update ".IPLOCK." set statu=0,stoptime='".time()."',optime='".time()."' where id in ($delid)";
		$db->query($sql);
	}
	getipdata();
}
if(!empty($_GET['lockall'])&&empty($_GET['action']))
{
	if(is_array($_GET['checkip']))
	{
		$delid=implode(",",$_GET['checkip']);
		$sql="update ".IPLOCK." set statu=1,stoptime='".(time()+3600*24*365)."',optime='".time()."' where id in ($delid)";
		$db->query($sql);
	}
	getipdata();
}
if(!empty($_GET['delrecord'])&&empty($_GET['action']))
{
	if(is_array($_GET['checkip']))
	{
		$delid=implode(",",$_GET['checkip']);
		$sql="delete from ".IPLOCK." where id in ($delid)";
		$db->query($sql);
	}
	getipdata();
}
//-------------------------------------------------------
function getipdata()
{
	global $db;
	$sre=array();
	$sql="select ip,type from ".IPLOCK." where statu=1";
	$db->query($sql);
	$re=$db->getRows();
	foreach ($re as $v)
	{
		if($v['type']==1)
			$stop_view[]=$v['ip'];
		else
			$stop_reg[]=$v['ip'];
	}
	$stop_view=serialize($stop_view);
	$stop_reg=serialize($stop_reg);
	
	$write_str='<?php $stop_view = unserialize(\''.$stop_view.'\');$stop_reg=unserialize(\''.$stop_reg.'\');?>';//生成要写的内容
	$fp=fopen('../config/stop_ip.php','w');
	fwrite($fp,$write_str,strlen($write_str));//将内容写入文件．
	fclose($fp);
}

function convertip($ip, $ipdatafile)
{
	static $fp = NULL, $offset = array(), $index = NULL;
	$ipdot = explode('.', $ip);
	$ip    = pack('N', ip2long($ip));
	$ipdot[0] = (int)$ipdot[0];
	$ipdot[1] = (int)$ipdot[1];
	if($fp === NULL && $fp = @fopen($ipdatafile, 'rb'))
	{
		$offset = unpack('Nlen', fread($fp, 4));
		$index  = fread($fp, $offset['len'] - 4);
	}
	elseif($fp == FALSE)
	{
		return  '- Invalid IP data file';
	}
	$length = $offset['len'] - 1028;
	$start  = unpack('Vlen', $index[$ipdot[0] * 4] . $index[$ipdot[0] * 4 + 1] . $index[$ipdot[0] * 4 + 2] . $index[$ipdot[0] * 4 + 3]);

	for ($start = $start['len'] * 8 + 1024; $start < $length; $start += 8)
	{
		if ($index{$start} . $index{$start + 1} . $index{$start + 2} . $index{$start + 3} >= $ip)
		{
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
<HTML>
<head>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<script language="javascript" src="../script/Calendar.js"></script>
<script type="text/javascript">
function checkall()
{
	 for(var j = 0 ; j < document.getElementsByName("checkip[]").length; j++)
	 {
	  	if(document.getElementsByName("checkip[]")[j].checked==true)
	  	  document.getElementsByName("checkip[]")[j].checked = false;
		else
		  document.getElementsByName("checkip[]")[j].checked = true;
	 }
}
</script>
<div class="bigbox">
	<div class="bigboxhead">Блокировка IP адресов</div>
	<div class="bigboxbody">
	<form name="iplockset" action="iplockset.php" method="post" style="margin-top:0px;">
	<table width="100%" height="154" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="11%" height="28"   align="left" >
			<?php echo lang_show('ipaddr');?>
			<script language="javascript">
			var cdr = new Calendar("cdr");
			document.write(cdr);
			cdr.showMoreDay = true;
			</script>
			</td>
			<td width="89%"   align="left" ><input name="addlockip" type="text" id="addlockip" size="30" maxlength="30"></td>
        </tr>
        <tr>
          <td height="28"   align="left" >Период</td>
		  <td   align="left" ><input onFocus="cdr.show(this);" name="locktime" type="text" id="locktime" size="30" maxlength="10"></td>
        </tr>
        <tr>
          <td height="37"   align="left" >Тип</td>
		  <td   align="left" >
		  <select name="type" id="type">
		    <option value="1" selected>Заблокировать</option>
		    <option value="2">Запретить регистрацию</option>
          </select>
		  </td>
        </tr>
        <tr>
          <td   align="left" >&nbsp;</td>
          <td   align="left" ><input class="btn" type="submit" name="Input" id="addip" value="Отправить"></td>
        </tr>
	</table>
	</form>
	</div>
	</div>
<div class="bigbox" style="margin-top:8px;">
	<div class="bigboxhead">Заблокированные IP адреса</div>
	<div class="bigboxbody">
	<form name="iplockset" action="" method="GET" style="margin-top:0px;">
	<table width="100%" height="132" border="0" cellpadding="0" cellspacing="0">
	<?php
	unset($sql);
	if(!empty($_GET['sip']))
	{
		$_GET['sip']=trim($_GET['sip']);
		$sql=" and ip='$_GET[sip]' ";
	}
	if(!empty($_GET['type']))
	{
		$sql=" and type='$_GET[type]' ";
	}
	$sql="select * from ".IPLOCK." where 1 $sql order by id desc ";
	$page = new Page;
	$page->listRows=20;
	if (!$page->__get('totalRows'))
	{
		$db->query($sql);
		$page->totalRows = $db->num_rows();
	}
	$sql .= "  limit ".$page->firstRow.",20";
	$pages = $page->prompt();   
	$db->query($sql);
	$re=$db->getRows();
	?>
        <tr>
          <td align="left" >&nbsp;</td>
          <td colspan="4" align="left" >
            IP  <input name="sip" type="text" value="<?php echo $_POST['sip'];?>" id="sip">
                Тип
                <select name="type" id="type">
                  <option value="">Все</option>
                  <option value="1" <?php if($_GET['type']==1) echo 'selected';?>>Блокировка</option>
                  <option value="2" <?php if($_GET['type']==2) echo 'selected';?>>Запрет регистрации</option>
                </select>
            <input name="Submit" type="submit" class="btn" value="Найти">
			</td>
          <td height="24" colspan="3" align="right" ><div class="page"><?php echo $pages?></div></td>
        </tr>
        <tr>
          <td align="left" >
          <input type="checkbox" name="checkipall" id="checkipall" onClick="checkall()"></td>
          <td align="left" ><?php echo lang_show('lockedip');?></td>
          <td align="left" ><?php echo lang_show('nowstatu');?></td>
          <td align="left" >Разблокирование</td>
          <td align="left" >Тип блокировки</td>
          <td align="left" ><?php echo lang_show('optime');?></td>
          <td align="left" >Действие</td>
          <td height="24" align="left" ><?php echo lang_show('options');?></td>
        </tr>
        <?php
           foreach($re as $v)
	       {
        ?>
        <tr>
          <td width="53" align="left"><input type="checkbox" name="checkip[]" value="<?php echo $v['id'];?>"></td>
          <td width="284" align="left">
		  <?php 
			echo $v['ip']; 
			if($v['ip'])
			{	
				echo '['.convertip($v['ip'], '../lib/tinyipdata.dat').']';
			}
		  ?>		  </td>
          <td width="112" align="left">
		  <?php 
			  if($v['statu']==1) 
				  echo "<font color='#FF3300'>".lang_show('locking')."</font>";
			  else
				  echo lang_show('unlock');
		  ?>		  </td>
          <td width="112" align="left" ><?php echo dateformat($v['stoptime']);?></td>
          <td width="99" align="left" ><?php 
			  if($v['type']==1) 
				  echo "Доступ запрещен";
			  else
				  echo "Регистрация запрещена";
		  ?></td>
          <td width="115" align="left" ><?php echo dateformat($v['optime']);?></td>
          <td width="112" align="left" ><?php echo $v['reason'];?></td>
          <td width="143" height="24" align="left" ><?php
		  if ($v['statu']==1)
		  {
		  ?>
		  <a href="iplockset.php?action=release&lockid=<?php echo $v['id'];?>"><?php echo lang_show('olock');?></a>
          <?php
		  }
		  else
		  {
		  ?>
           <a href="iplockset.php?action=lock&lockid=<?php echo $v['id'];?>"><?php echo lang_show('lockit');?></a>
        <?php
		  }
          }
        ?>		  </td>
       </tr>
        <tr>
          <td colspan="5" align="left" style="text-align:left">
		  <input class="btn" type="submit" name="delrecord" id="delrecord" value="Удалить">
		  <input class="btn" type="submit" name="releaseall" value="Разблокировать" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');">
            <input name="lockall" type="submit" class="btn" id="alllock" value="Заблокировать"></td>
          <td height="24" colspan="3" align="right">&nbsp;<div class="page"><?php echo $pages?></div></td>
        </tr>
      </table>
	</form>
	</div>
</div>
</body>
</html>