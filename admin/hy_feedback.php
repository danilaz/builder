<?php
include_once("../includes/global.php"); 
include_once("../includes/page_utf_class.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//=================================================
if(!empty($_POST["del"])&&count($_POST["del"])>0)
{
	for($i=0;$i<count($_POST["del"]);$i++)
	{
		$id=$_POST["del"][$i];
		$db->query("delete from ".FEEDBACK." where id='$id'");
	}
}
//--------------------------------------------------
if(!empty($_GET['key']))
	$psql=" and (sub like '%$_GET[key]%' or con like '$_GET[key]' )";
if(!empty($_GET['from']))
	$psql.=" and fromuserid in (select userid from ".USER." where company='$_GET[from]')";
if(!empty($_GET['to']))
	$psql.=" and touserid in (select userid from ".USER." where company='$_GET[to]')";
$sql="select * from ".FEEDBACK." where 1 $psql order by id desc"; 
//-----------------
$page = new Page;
if (!$page->__get('totalRows')){
	$db->query($sql);
	$page->totalRows = $db->num_rows();
}
$sql .= "  limit ".$page->firstRow.", ".$page->listRows;
$pages = $page->prompt();
//----------------
$db->query($sql);
$re=$db->getRows();
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="main.js"></script>
</HEAD>
<body>
<script language="javascript">
function do_select()
{
	 var box_l = document.getElementsByName("del[]").length;
	 for(var j = 0 ; j < box_l ; j++)
	 {
	  	if(document.getElementsByName("del[]")[j].checked==true)
	  	  document.getElementsByName("del[]")[j].checked = false;
		else
		  document.getElementsByName("del[]")[j].checked = true;
	 }
}
</script>

<form method="get" action="">
<div class="bigbox">
<div class="bigboxhead"><?php echo lang_show('msg_query');?></div>
<div class="bigboxbody">
&nbsp;
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="9%">Отправитель</td>
    <td width="91%"><input name="from" type="text" id="from" value="<?php if(!empty($_GET['from'])) echo $_GET['from'];?>"></td>
  </tr>
  <tr>
    <td>Получатель</td>
    <td><input name="to" type="text" id="to" value="<?php if(!empty($_GET['to'])) echo $_GET['to'];?>"></td>
  </tr>
  <tr>
    <td>Ключевые слова</td>
    <td><input type="text" name="key" value="<?php if(!empty($_GET['key'])) echo $_GET['key'];?>"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input class="btn" type="submit" name="Submit" value="<?php echo lang_show('search');?>"></td>
  </tr>
</table>
</div>
</div>
</form>
<div style="float:left; height:50px; width:80%;">&nbsp;</div>

<form action="" method="post">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('msg_list');?></div>
	<div class="bigboxbody">
<table width="100%" border="0" cellpadding="4" cellspacing="0" >
  <tr  height="33"> 
    <td width="35" ><input type="checkbox" name="checkbox" onClick="do_select()" value="checkbox" /></td>
    <td width="560"><?php echo lang_show('content');?></td>
    <td width="60" ><?php echo lang_show('query');?></td>
	<td width="60" ><?php echo lang_show('ifback');?></td>
    <td width="80" ><?php echo lang_show('send');?></td>
    <td width="81" ><?php echo lang_show('receive');?></td>
    <td width="88" ><?php echo lang_show('time');?></td>
  </tr>
    <tr  onMouseOver="mouseOver(this)" onMouseOut="mouseOut(this,'odd')">
    <td colspan="7" align="right"><div class="page"><?php echo $pages?></div></td>
    </tr>
  <?php 
	for($i=0;$i<count($re);$i++)
	{
		$id=$re[$i]['id'];
		$sub=$re[$i]['sub'];
		$con=$re[$i]['con'];
		$fid=$re[$i]['fromuserid'];
		$touserid=$re[$i]['touserid'];
		$dat=$re[$i]['date'];
		if(!empty($fid))
		{
			$db->query("select company from ".USER." where userid='$fid'");
			$com=$db->fetchRow();
			$fcompany=$com['company'];
		}
		else
			$fcompany=NULL;
		if(!empty($touserid))
		{
			$db->query("select company from ".USER." where userid='$touserid'");
			$com=$db->fetchRow();
			$tcompany=$com['company'];
		}
		else
			$fcompany=NULL;
	?>
  <tr  onMouseOver="mouseOver(this)" onMouseOut="mouseOut(this,'odd')"> 
    <td width="35"><input type="checkbox" name="del[]" id="de<?php echo $i?>" value="<?php echo $id; ?>"></td>
    <td>
		<div style="overflow:auto; width:100%; height:50px;"><?php echo "$sub<br>";echo "$con"; ?></div>	</td>
    <td width="60" >
	<?php
	if(empty($re[$i]["iflook"]))
		echo lang_show('nolook');
	if($re[$i]["iflook"]==1)
		echo lang_show('looked');
	if($re[$i]["iflook"]==2)
		echo lang_show('udeled');
	?></td>
	<td width="60" >
	<?php 
	if($re[$i]["ifback"]==1)
		echo lang_show('backed');
	else
		echo lang_show('noback');
	?></td>
    <td width="80" >
	<?php
	 if(!empty($fcompany))
	 	 echo $fcompany;
	 else
	 	echo $re[$i]["fromInfo"];
	 ?>&nbsp;</td>
    <td width="81" ><?php echo "$tcompany"; ?>[<a href="sendmail.php?userid=<?php echo $touserid;?>">Уведомить</a>]</td>
    <td width="88" ><?php echo $dat;?></td>
  </tr>
   <?php 
	}
	?> 
  <tr>
    <td colspan="1" align="left"><input class="btn" type="submit" name="Submit2" value="<?php echo lang_show('delete');?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');"></td>
    <td colspan="6" align="right"><div class="page"><?php echo $pages?></div></td>
    </tr>
</table>
</div>
</div>
</form>
</body>
</html>

