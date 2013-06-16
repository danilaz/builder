<?php
include_once("../includes/global.php"); 
include_once("../includes/page_utf_class.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("../lang/" . $config['language'] . "/user_admin/cashflow_config.php");
include_once("auth.php");
//====================================
if(!empty($_POST["charge"])&&!empty($_POST["points"])&&is_numeric($_POST["points"])&&!empty($_POST['uname']))
{	
	$add_time = time();
	$_POST['uname']=trim($_POST['uname']);
	$sql="select userid from ".ALLUSER." where user='$_POST[uname]'";
	$db->query($sql);
	$v=$db->fetchRow();
	if(!empty($v))
	{
		$sql="update ".ALLUSER." set cash=cash+".$_POST["points"]." where user='$_POST[uname]'";
		$db->query($sql);
	
		$sql = "insert into ".CASHFLOW." 
		(userid,amount,cashflow_type,add_time,user_note,is_succeed,success_time,censor,check_time)
		values
		('$v[userid]',$_POST[points],'8','$add_time','1',1,$add_time,'$_SESSION[ADMIN_USER]',$add_time)";
		$db->query($sql);
	}
	msg('member_charge.php');
}
if(!empty($_GET['del']))
{
	$db->query("delete from ".CASHFLOW." where id='$_GET[del]'");
}
//=============================
if(!empty($_GET['type']))
	$sql=" and a.cashflow_type='$_GET[type]' ";
if(!empty($_GET['user']))
	$sql.=" and (b.user='$_GET[user]' or b.company='$_GET[user]') ";
if(!empty($_GET['stime']))
{
	$stime=strtotime($_GET['stime']);
	$sql.=" and a.success_time>'$stime' ";
}
if(!empty($_GET['etime']))
{
	$etime=strtotime($_GET['etime']);
	$sql.=" and a.success_time<'$etime' ";
}
if(!empty($_GET['admin']))
	$sql.=" and a.censor='$_GET[admin]' ";
	
$sqlg="select a.*,b.user,b.company from ".CASHFLOW." a left join ".USER." b on a.userid=b.userid 
where 1 $sql order by a.add_time desc";
//-----------------------------------
$page = new Page;
$page->listRows=20;
if (!$page->__get('totalRows'))
{
	$db->query($sqlg);
	$page->totalRows = $db->num_rows();
}
$sqlg .= "  limit ".$page->firstRow.",20";
$pages = $page->prompt();
$db->query($sqlg);
$rg=$db->getRows();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="main.js"></script>
<title><?php echo lang_show('admin_system');?></title>
</head>
<body>
<script>
function check_value()
{
	var v=document.getElementById("points").value*1;
	if(!v||v=='NaN')
		document.getElementById("charge").disabled=true;
	else
		document.getElementById("charge").disabled=false;
}
</script>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('mc');?></div>
	<div class="bigboxbody">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<form name="frmuser" method="POST" action="member_charge.php">
<tr > 
      <td width="60%" ><?php echo lang_show('uname');?>
		<input name="uname" type="text" id="uname" size="20" maxlength="20">
		<?php echo lang_show('cmount');?>
		<input name="points" type="text" id="points" size="10" maxlength="10" onKeyUp="check_value();">
		<input class="btn" type="submit" name="charge" id="charge" value="<?php echo lang_show('sc');?>" disabled onClick="return confirm('<?php echo lang_show('surec');?>')"></td>
  </tr>
  <?php 
  if(!empty($f)&&$f=='t')
  {
  ?>
  <tr > 
      <td width="60%" height="22"><font color="red"><?php echo lang_show('nou');?></font></td>
  </tr>
  <?php }?>
</form>
</table>
  </div>
</div>

<div style="float:left; height:20px; width:80%;">&nbsp;</div>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('clist');?></div>
	<div class="bigboxbody">
<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center" class="menu">
  <tr height="25">
    <td height="107" colspan="8"  align="left" style="padding:0px; border-bottom:1px solid #666666;" >
	<form action="" method="get">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10%">Тип</td>
        <td width="90%"><select name="type" id="type">
          <option value="">Все</option>
		  <?php
		  foreach($cash['cashtype'] as $key=>$v)
		  {
			  if($_GET['type']==$key)
				$str="selected";
			  else
				$str='';
		  	  echo '<option '.$str.' value="'.$key.'">'.$v.'</option>';
		  }
		  ?>
          </select></td>
      </tr>
      <tr>
        <td>Администратор</td>
        <td><input value="<?php echo $_GET['admin'];?>" name="admin" type="text" id="admin"></td>
      </tr>
      <tr>
        <td>Пользователь</td>
        <td><input value="<?php echo $_GET['user'];?>" name="user" type="text" id="user"></td>
      </tr>
      <tr>
        <td>Дата</td>
        <td>
          <input value="<?php echo $_GET['stime'];?>" name="stime" type="text" id="stime">
        －
        <input value="<?php echo $_GET['etime'];?>" name="etime" type="text" id="etime">        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="Submit" type="submit" class="btn" value="Найти"></td>
      </tr>
    </table>
	</form></td>
    </tr>
  <tr height="25" style="font-weight:bold;"> 
  	<td width="20" height="40"  align="left" >Номер</td>
    <td width="93"  align="left" >Тип</td>
    <td width="58"  align="left" >Статус</td>
    <td width="51"  align="left" >Количество</td>
    <td width="165"  align="left" >Примечания</td>
    <td width="221" align="left" ><?php echo lang_show('ctt');?></td>
    <td width="188" align="left" >Дата</td>
    <td width="49" align="left" >Действие</td>
  </tr>
	<?php
	foreach($rg as $v)
	{
	 ?>
  <tr> 
    <td width="20" align="left"><?php echo $v['flowid'];?><?php echo $v['censor'];?></td>
    <td align="10%"><?php echo $cash['cashtype'][$v['cashflow_type']]?></td>
    <td align="10%"><?php if($v['is_succeed']==1) echo '<font color=green>Выполнено</font>';else echo 'Не выполнено';?></td>
    <td align="15%"><?php echo $v['amount']. ' ' .$config['money'];?></td>
    <td align="15%"><?php echo $cash['note'][$v['user_note']];?></td>
    <td width="221" align="left"><?php echo '['.$v['user'].']<br>'.$v['company'];?></td>
    <td width="188" align="left"><?php echo date("Y-m-d H:m:s",$v['add_time']);if($v['success_time']>0) echo '<br>'.date("Y-m-d H:m:s",$v['success_time']);?></td>
    <td width="49" align="left"><a onClick="return confirm('Вы подтверждаете удаление?');" href="?del=<?php echo $v['id'];?>"><?php echo $delimg;?></a></td>
  </tr>
	<?php
	}
	?>
	<tr><td colspan="8" align="right" ><div class="page"><?php echo $pages?></div></td>
	</tr>
</table>
	</div>
</div>
</body>
</html>