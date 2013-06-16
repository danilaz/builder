<?php
include_once("../includes/global.php");
header("Pragma: no-cache");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/".$sctiptName);
include_once("auth.php");
//==================================
if(!empty($_POST["action"]))
{
	$_POST['rank']=empty($_POST['rank'])?0:$_POST['rank'];
	$_POST['tj']=empty($_POST['tj'])?0:$_POST['tj'];
	$_POST['stime']=strtotime($_POST['stime']);
	$_POST['etime']=strtotime($_POST['etime']);
	$_POST['regtime']=empty($_POST['regtime'])?date("Y-m-d H:i"):$_POST['regtime'];

	$sql="select userid from ".ALLUSER." where userid='$_GET[userid]' ";
	$db->query($sql);
	$uid=$db->fetchRow();
	if(!$uid['userid'])
	{
		$sql="insert into ".USER." (userid) values ('$_GET[userid]')";
		$db->query($sql);
	}
	if(!empty($_POST['password'])) 
	{
		$sql="update ".ALLUSER." set password='".md5($_POST['password'])."' where userid='$_GET[userid]'";
		$db->query($sql);
	}

	$sql="update ".USER." set 
		ifpay='$_POST[ifpay]',tj='$_POST[tj]',stime='$_POST[stime]',etime='$_POST[etime]',
		rank='$_POST[rank]',point='$_POST[point]',regtime='$_POST[regtime]' 
		where userid='$_GET[userid]'";
	$re=$db->query($sql);
	if($re)
	{
		$sql="update ".PRO." set ifpay='$_POST[ifpay]' where userid='$_GET[userid]'";
		$db->query($sql);
		$sql="update ".INFO." set ifpay='$_POST[ifpay]' where userid='$_GET[userid]'";
		$db->query($sql);
		unset($_GET['id']);
		msg("member.php?".implode('&',convert($_GET)));
	}
}
//=====================================================
$sh=$pn=$py=$ps=NULL;
$sql="select * from ".USER." a ,".ALLUSER." b where a.userid='$_GET[userid]' and a.userid=b.userid";
$db->query($sql);
$re=$db->fetchRow();


$ip=$re['ip'];
$regtime=$re['regtime'];
$ifpay=$re['ifpay'];
$tj=$re['tj'];
$point=$re['point'];
if($re['stime'])
	$stime=date("Y-m-d",$re['stime']);
if($re['etime'])
	$etime=date("Y-m-d",$re['etime']);
$rank =$re['rank'];
$position=$re['position'];
$cash=$re['cash'];
$lastLoginTime=$re['lastLoginTime'];
//========================================
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
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../script/Calendar.js"></script>
<style>
input{width:300px;}
</style>
</head>
<body>
<div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('mem_modify_info');?></div>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('mem_modify_info');?></div>
	<div class="bigboxbody">
      <form method="post" action=""  name=cityform enctype="multipart/form-data">
        <table width='98%' border='0' cellspacing='0' cellpadding='0' bordercolor='#000000' bordercolorlight='#000000' bordercolordark='#FFFFFF' align="center" class="menu">
          <tr>
            <td height="24" align="right"><?php echo lang_show('accounts');?></td>
            <td><?php echo $cash?></td>
          </tr>
          <tr>
            <td height="24" align="right"><?php echo lang_show('regip');?></td>
            <td>
			<?php 
				if($ip)
				{	
					echo $ip;
					$ipfile="../lib/tinyipdata.dat";
					echo $from = convertip($ip, $ipfile);
				}
			?>
			</td>
          </tr>
          <tr>
            <td height="24" align="right">Последний визин</td>
            <td><?php echo date("Y-m-d H:i:s",$lastLoginTime) ;?></td>
          </tr>
          <tr> 
<td width='15%' height="24" align="right"> 
  <?php echo lang_show('recommend');?></td>
<td width='92%'>
<?php
$rc_member = array(
	'0'=>lang_show('norec'),
	'1'=>lang_show('reccom'),
	'2'=>lang_show('startcom'),
)
?>
  <select name="tj">
	  <?php foreach($rc_member as $key=>$v) {?>
        <option value="<?php echo $key; ?>" <?php if($tj==$key)echo "selected"; ?>><?php echo $v;?></option>
      <?php } ?>
   </select></td>
          </tr>
          <tr> 
<td width='15%' height="24" align="right"><?php echo lang_show('member_level');?></td>
<td width='92%'>
  <select name="ifpay">
        <?php
             $sql="select * from ".USERGROUP." order by group_id asc";
            $db->query($sql);
            $re=$db->getRows();
            foreach($re as $v)
	        {
        ?>
        <option value="<?php echo $v['group_id'];?>"
		<?php if ($v['group_id']==$ifpay) echo " selected";?>><?php echo $v['name'];?></option>
        <?php
        }
        ?>
  </select>
  </td>
          </tr>
		  <tr>
            <td height="24" align="right"><?php echo lang_show('vloid_time');?></td>
		    <td>
			<script language="javascript">
			var cdr = new Calendar("cdr");
			document.write(cdr);
			cdr.showMoreDay = true;
			</script>
			  <input type="text" name="stime" value="<?php echo $stime?>" onFocus="cdr.show(this);" style="width:100px;">
		      -
		      <input type="text" name="etime" value="<?php echo $etime?>" onFocus="cdr.show(this);" style="width:100px;">
		      (exp:2008-02-01) </td>
	      </tr>
		  <tr>
		    <td height="24" align="right"><?php echo lang_show('mod_password');?></td>
		    <td><input type="text" name="password" id="password"></td>
	      </tr>
		  <tr> 
<td width='15%' height="24" align="right"><?php echo lang_show('mem_credit');?></td>
<td width='92%'>
			<input name="point" type="text" value="<?php if(!empty($point)) echo $point; else echo 0;?>">			</td>
          </tr>
          <tr>
            <td height="24" align="right"><?php echo lang_show('rank');?></td>
            <td><input name="rank" type="text" id="rank" value="<?php echo $rank?>"></td>
          </tr>
          <tr>
            <td height="24" align="right"><?php echo lang_show('reg_time');?></td>
            <td><input type="text" name="regtime" id="regtime" value="<?php echo "$regtime"; ?>"></td>
          </tr>
          <tr> 
			<td width='15%' height="24">&nbsp;</td>
			<td width='92%'> 
			  <input class="btn" style="width:100px;" type='submit' name='submit' value='<?php echo lang_show('submit');?>'>
			  <input name="action" type="hidden" id="action" value="submit">			  </td>
          </tr>
        </table>
      </form>
	</div>
</div>
</body>
</html>