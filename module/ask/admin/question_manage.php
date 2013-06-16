<?php
include_once("../includes/page_utf_class.php");
//=======================================
if(!empty($_GET['delid']))
{
		$sql="delete from ".QUESTION ." where id='$_GET[delid]'";
		$db->query($sql);
		$sql="delete from ".QUESTDETAIL." where question_id='$_GET[delid]'";
		$db->query($sql);
		$sql="delete from ".ANSWER." where question_id='$_GET[delid]'";
		$db->query($sql);
}
if(!empty($_GET['delmych'])&&is_array($_GET["de"]))
{
	$id=implode(",",$_GET["de"]);
	$sql="delete from ".QUESTION ." where id in ($id)";
	$db->query($sql);
	$sql="delete from ".QUESTDETAIL." where question_id in ($id)";
	$db->query($sql);
	$sql="delete from ".ANSWER." where question_id in ($id)";
	$db->query($sql);
}
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('qm');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<form name="qmana" action="" method="get">
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('qs');?></div>
	<div class="bigboxbody">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10%"><?php echo lang_show('qt');?></td>
    <td width="90%"><input name="qtitle" type="text" value="<?php if(!empty($_GET['qtitle'])) echo $_GET['qtitle'];?>" size="60"> </td>
  </tr>
  <tr>
    <td><?php echo lang_show('sta');?></td>
    <td><select name="qstatu">
	<option value=""><?php echo lang_show('allask');?></option>
	<option value="1" <?php if(!empty($_GET['qstatu'])&&$_GET['qstatu']=='1') echo 'selected';?>><?php echo lang_show('newask');?></option>
	<option value="reward" <?php if(!empty($_GET['qstatu'])&&$_GET['qstatu']=='reward') echo 'selected';?>><?php echo lang_show('rewardask');?></option>
	<option value="2" <?php if(!empty($_GET['qstatu'])&&$_GET['qstatu']=='2') echo 'selected';?>><?php echo lang_show('hdeel');?></option>
	</select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<input class="btn" type="submit" value=" Отправить">
	<input name="m" type="hidden" value="<?php echo $_GET['m'];?>">
	<input name="s" type="hidden" value="<?php echo $_GET['s'];?>">
	</td>
  </tr>
</table>
	</div>
</div>

<div style="float:left; height:50px; width:50%;">&nbsp;</div>
<script language="javascript">
function do_select()
{
	 var box_l = document.getElementsByName("de[]").length;
	 for(var j = 0 ; j < box_l ; j++)
	 {
	  	if(document.getElementsByName("de[]")[j].checked==true)
	  	  document.getElementsByName("de[]")[j].checked = false;
		else
		  document.getElementsByName("de[]")[j].checked = true;
	 }
}
</script>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('allask');?></div>
	<div class="bigboxbody">
  <table width="100%" border="0" align="left" cellpadding="2" cellspacing="0" >
    <tr > 
      <td width="20" height="20" ><input onClick="do_select()" name="" type="checkbox"></td>
      <td width="336" ><?php echo lang_show('qtitl');?></td>
	  <td width="212" ><?php echo lang_show('whoask');?></td>
      <td width="81" ><?php echo lang_show('qsta');?></td>
      <td  width="132" ><?php echo lang_show('ptime');?></td>
      <td width="125" align="center" ><?php echo lang_show('manager');?></td>
    </tr>
    <?php
	$tsql=NULL;
	if(!empty($_GET['qtitle']))
		$tsql.=" and a.title like '%".trim($_GET['qtitle'])."%' ";
	if(!empty($_GET['qstatu'])&&$_GET['qstatu']!='reward')
		$tsql.=" and a.statu='$_GET[qstatu]'";
	if(!empty($_GET['qstatu'])&&$_GET['qstatu']=='reward')
		$tsql.=" and a.reward>0";
	$sql="select a.*,b.user,b.company from ".QUESTION." a left join ".USER." b on a.userid=b.userid where 1 $tsql order by a.uptime desc";
	//=============================
	  	$page = new Page;
		$page->listRows=20;
		if (!$page->__get('totalRows')){
			$db->query("select count(*) as num from ".QUESTION." a where 1 $tsql");
			$page->totalRows=$db->fetchField('num');
		}
        $sql .= "  limit ".$page->firstRow.",20";
		$pages=$page->prompt();
	//=====================
		$db->query($sql);
		$re=$db->getRows();
		foreach($re as $va)
		{
	?> 
    <tr> 
      <td width="20"> 
      <input name="de[]"  type="checkbox" value="<?php echo $va['id']; ?>">
      </td>
      <td width="336">
	  <?php if($va['reward']>0) {echo '<img src="'.$config['weburl'].'/image/default/mon.gif">';echo $va['reward'];} ?><a href="<?php echo $config['weburl'];?>/?m=ask&s=question&id=<?php echo $va['id'];?>"><?php echo $va['title'];?> </a>      </td>
      <td>[<?php echo $va['user']; ?>] &nbsp;<?php echo $va['company']; ?></td>
      <td><?php 
		if($va['statu']==1) 
			echo '<img src="'.$config['weburl'].'/image/default/nask.gif">';
		elseif($va['statu']==2)
			echo '<img src="'.$config['weburl'].'/image/default/answer.gif">';
		else
			echo '<img src="'.$config['weburl'].'/image/default/expired.gif">';
		?>
		</td>
		<td>[<?php echo date("Y-m-d H:m:s",$va['uptime']); ?></td>
      <td align="center">
         <a href="<?php echo $config['weburl'];?>/?m=ask&s=question&id=<?php echo $va['id'];?>" target="_blank">
		 <?php echo lang_show('qudet');?></a>
		 <a href="?delid=<?php echo $va['id'];?>&m=<?php echo $_GET['m'];?>&s=<?php echo $_GET['s'];?>">
		 <?php echo lang_show('qdel');?></a>
	   </td>
      </tr>
	  <?php }?>
		 <tr> 
      <td colspan="6"> <div class="page"><?php echo $pages?></div></td>
      </tr>
	  <tr> 
      <td colspan="6"> 
    <input  class="btn" type="submit" name="delmych" value="<?php echo lang_show('chdel');?>">
      </td>
      </tr>
  </table>
  </div>
</div>
  </form>
</body>
</html>