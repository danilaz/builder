<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
//=====================================
if(!empty($_GET['cat_type']))
{
	if($_GET['cat_type']=='com')
		$_SESSION['cat_type']=COMPANYCAT;
	elseif($_GET['cat_type']=='album')
		$_SESSION['cat_type']=ALBUMCAT;
	else
		$_SESSION['cat_type']=PCAT;
}
$cat_table=empty($_SESSION['cat_type'])?PCAT:$_SESSION['cat_type'];
if(!empty($_POST["cc"])&&$_POST["cc"]==lang_show('edit_nums'))
{
	for($i=0;$i<count($_POST["nums"]);$i++)
	{
		if(empty($_POST["nums"][$i]))
			$_POST["nums"][$i]=0;
		$sql="update $cat_table set nums='".$_POST["nums"][$i]."' where catid='".$_POST["updateID"][$i]."'";
		$db->query($sql);
	}
	msg("?catid=$_GET[catid]");
}
if(!empty($_POST["catid"])&&$_POST["updateID"]&&$_POST["cc"]!=lang_show('edit_nums'))
{
	$catid=implode(",",$_POST["catid"]);
	$db->query("delete from $cat_table where catid in ($catid)");
}
?>
<HTML>
<head>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />

</head>
<script type="text/javascript">
function show(id)
{
	var buylist_con="cat"+id;
	var span="s"+id;
	
	if(document.getElementById(buylist_con).style.display=="block")
	{
		document.getElementById(buylist_con).style.display="none";
		document.getElementById(span).innerHTML="<img src='../image/default/adding.gif' border=0>";
	}
	else
	{
		document.getElementById(buylist_con).style.display="block";
		document.getElementById(span).innerHTML="<img src='../image/default/decrease.gif' border=0>";
	}
}
</script>
<body>

<div class="bigbox">
	<div class="bigboxhead  tab" style=" width:80%;">
    <span class="cbox <?php if($cat_table==PCAT) echo 'on';?>"><a href="?cat_type=pcat">Продукты</a></span>
    <span class="cbox <?php if($cat_table==COMPANYCAT) echo 'on';?>"><a href="?cat_type=com">Компании</a></span>
    <span class="cbox <?php if($cat_table==ALBUMCAT) echo 'on';?>"><a href="?cat_type=album">Альбомы</a></span>
    </div>
	<div class="bigboxbody" style="margin-top:-1px;">
    
<form method="post" action="">

<div style="clear:both;"></div>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <?php if(!empty($_GET['catid'])){?>
  <tr><td colspan="4"><a href="javascript:history.back();">&lt;&lt;На уровень выше</a></td></tr>
  <?php } ?>
  <!-- tr>
		<td colspan="4">
		<div class="char_index">
/*			<?php
				echo "<a href='pro_info_cat.php' >Все</a>";
				for($i=ord("А");$i<=ord("Я");$i++)  
				echo "<a href='?char=".chr($i)."' >".chr($i)."</a>";
			?>*/
		</div>
		</td>
  </tr -->
<?php
if(empty($_GET['catid']))
	$tsql=" and catid<=9999";
else
	$tsql=" and catid>$_GET[catid]00 and catid<$_GET[catid]99";

if(!empty($_GET['char']))
	$tsql.=" and char_index='$_GET[char]'";

$sql="select * from $cat_table where 1 $tsql order by nums asc,char_index asc";
$db->query($sql);
$re=$db->getRows();
foreach($re as $v)
{
?>
    <tr>
    <td width="5%" height="20" ><input name="catid[]" type="checkbox" value="<?php echo "$v[catid]"; ?>"></td>
      <td width="50%" height="20">
	  <?php 
	  	if($v['isindex'])
			echo "[1 уровень] ";
	  	echo "<a href=?catid=$v[catid]>$v[cat]</a>";
		if($v['pic']) 
			echo "&nbsp;&nbsp;<img align='absmiddle' width='22' height='22' src='$v[pic]' >";
		
	  ?>
	  </td>
      <td width="5%" height="20"><input name="nums[]" type="text" id="nums[]2" value="<?php echo $v['nums']; ?>" size="3"></td>
      <td width="40%" height="20">
	  <a href="pro_info_add_cat.php?id=<?php echo $v["catid"]; ?>"><?php echo lang_show('modify');?></a> | 
      <a href="pro_info_add_cat.php?aid=<?php echo urlencode($v["catid"])?>"><?php echo lang_show('addsubcat');?></a>
      <input name="updateID[]" id="updateID[]" type="hidden" value="<?php echo "$v[catid]"; ?>">      </td>
    </tr>
<?php
} 
if(count($re)>0)
{
?>
    <tr>
      <td><input onClick="return confirm('<?php echo lang_show('are_you_sure')?>');" name="cc" class="btn" type="submit" value="<?php echo lang_show('delete');?>"></td>
      <td>&nbsp;</td>
      <td><input name="cc" class="btn" type="submit" value="<?php echo lang_show('edit_nums');?>"></td>
      <td>&nbsp;</td>
    </tr>
<?php } ?>
  </table>
</form>
</div>
</div>
</body>
</HTML>