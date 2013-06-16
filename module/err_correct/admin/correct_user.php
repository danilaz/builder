<?php
include_once("../includes/page_utf_class.php");
//================================
$submit		= isset($_GET['submit'])?$_GET['submit']:NULL;
$deid		= isset($_GET['deid'])?$_GET['deid']:NULL;
if(!empty($_GET['delmych'])&&is_array($_GET['de']))
{
	if(is_array($_GET['de']))
	{
		$id=implode(",",$_GET['de']);
		$sql="delete from ".USEREC." where id in ($id)";
		$db->query($sql);
	}
}
if($deid)
{
	$sql="delete from ".USEREC." where id=$deid";
	$db->query($sql);
}
?>
<html>
<HEAD>
<TITLE> <?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<!--<div class="guidebox"><?php echo lang_show('system_setting_home');?> &raquo; <?php echo lang_show('news_manager');?></div>-->
<form method="get" action="" name="form">
	<div class="bigbox">
		<div class="bigboxhead">Поиск</div>
			<div class="bigboxbody">
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
			  <tbody><tr>
				<td width="50px">Информация о состоянии</td>
				<td width="50px" align="left">
				<select name="statu">
				<option value="">Просмотреть все</option>
				<option value="1"><?php echo lang_show("corsr"); ?></option> 
				<option value="2"><?php echo lang_show("corse"); ?></option> 
				</select></td>
				<td align="left">
				<input type="hidden" value="err_correct" name="m">
				<input type="hidden" value="correct_user.php" name="s">
				<input type="submit" value=" Найти " name="submit" class="btn"></td>
			  </tr>
			  </tbody>
			</table>
			</div>
		<div style="float:left;height:50px; width:50%;">&nbsp;</div>
	</div>
</form>
<form name=form action="" method="get">
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
  <div class="bigboxhead"><?php echo lang_show('usercor');?></div>
  <div class="bigboxbody">
  <table width="100%" border="0" align="left" cellpadding="2" cellspacing="0">
    <tr > 
      <td width="10%" height="20" ><input onClick="do_select()" name="" type="checkbox"></td>
	  <td width="15%"><?php echo lang_show('corcomp'); ?></td>
      <td width="15%" ><?php echo lang_show('whocor');?></td>
      <td width="15%" align="left" ><?php echo lang_show('cortime');?></td>
	  <td width="15%" align="left" ><?php echo lang_show('corstatu');?></td>
      <td align="left" ><?php echo lang_show('manager');?></td>
    </tr>
<?php
	$tsql=NULL;
	$osql=NULL;
	if(!empty($_GET['statu']))
		$tsql.=" and a.statu =".intval($_GET['statu']);
	else
		$osql.=" a.statu DESC,";
	$sql="select a.id,a.fromuser,a.userid,a.ctime,a.statu,b.user,c.company FROM ".USEREC." a left join ".ALLUSER." b on a.fromuser=b.userid left join ".USER." c on c.userid=a.userid WHERE 1 $tsql order by $osql a.ctime ASC";
	//=============================
	$page = new Page;
	$page->listRows=20;
	if (!$page->__get('totalRows')){
		$db->query($sql);
		$page->totalRows = $db->num_rows();
	}
	$sql .= "  limit ".$page->firstRow.",20";
	$pages = $page->prompt();
	//-----------------------------
	$db->query($sql);
	$re=$db->getRows();
	foreach($re as $va)
	{ 
?> 
    <tr> 
      <td> 
        <input name="de[]" id="de" type="checkbox" value="<?php echo $va['id']; ?>" />
      </td>
	  <td><a target='_blank' href="<?php echo $config['weburl']."/shop.php?uid=".$va['userid']; ?>"><?php echo $va['company']; ?></a></td>
      <td><?php echo $va['user']!=''?'['.'<a target="_blank"  href="'.$config['weburl'].'/shop.php?uid='.$va['fromuser'].'">'.$va['user'].'</a>]':'[Гость]'; ?></td>
      <td><?php echo date("Y-m-d H:i:s",$va['ctime']); ?></td>
	　<td><?php echo $va['statu']==2?lang_show("corse"):"<font color='green'>".lang_show("corsr")."</font>"; ?></td>
      <td align="left" >
	  <a href='module.php?m=<?php echo $_GET['m'];?>&s=edit_user.php&<?php echo "uid=$va[userid]&id=$va[id]"; ?>'><?php echo lang_show('cordet'); ?></a>
       |<a href="module.php?&m=<?php echo $_GET['m'];?>&s=<?php echo $_GET['s'];?>&<?php echo "deid=$va[id]";?>" onClick="return confirm('<?php echo lang_show('are_you_sure'); ?>');"><?php echo lang_show('cordel'); ?></a></td>
    </tr>
    <?php 
	}
	?> 
	<tr>
      <td colspan="6">
      <input class="btn" type="submit" name="delmych" value="<?php echo lang_show('cchldel');?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');">
		<input name="m" type="hidden" id="m" value="<?php echo $_GET['m'];?>">
		<input name="s" type="hidden" id="s" value="<?php echo $_GET['s'];?>">
		</td>
      </tr>
	   <tr>
      <td colspan="6" align="center"><div class="page"><?php echo $pages?></div></td>
      </tr>
  </table>
  </div>
</div>
  </form>
</body>
</html>