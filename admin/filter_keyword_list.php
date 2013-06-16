<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
@include_once("../lang/" . $config['language'] . "/admin/".$sctiptName);
include_once("auth.php");
include_once("../includes/page_utf_class.php");
//=======================================
$keyword=isset($_GET['keyword'])?$_GET['keyword']:NULL;

if(!empty($_POST['submit'])&&is_array($_POST['de']))
{
	$id=implode(",",$_POST['de']);
	$sql="delete from ".FILTER." where id in ($id)";
	$db->query($sql);
	update_cache_filter();
}
if(!empty($_GET['id']))
{
    $sql="delete from ".FILTER." where id=".$_GET['id'];
	$db->query($sql);
	update_cache_filter();
}
function update_cache_filter()
{
	global $db;
	$sql="select * from ".FILTER;
	$db->query($sql);
	$re=$db->getRows();
	foreach($re as $v)
	{
		if($v['statu']==1)
		{	
			if(empty($banned))
				$banned="$v[keyword]";
			else
				$banned.="|$v[keyword]";
		}
		else
		{
			if(empty($find))
			{
				$find="'/$v[keyword]/i'";
				$replace="'$v[replace]'";
			}
			else
			{
				$find.=",'/$v[keyword]/i'";
				$replace.=",'$v[replace]'";
			}
		}
	}
	if(!empty($banned))
		$banned='/('.$banned.')/i';
	else
		$banned='';
	$str='<?php
	$find= array('.$find.');
	$replace=array('.$replace.');
	$banned=\''.$banned.'\';
	$_CACHE[\'word_filter\'] = Array
	(
		\'filter\' => Array
		(
			\'find\' => &$find,
			\'replace\' => &$replace
		),
		\'banned\' => &$banned
	);
	?>';
	$fp=fopen('../config/filter.inc.php','w');
	fwrite($fp,$str,strlen($str));//将内容写入文件．
	fclose($fp);
}
?>
<html>
<HEAD>
<TITLE> <?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>

<div class="bigbox">
	<div class="bigboxhead">Поиск</div>
	<div class="bigboxbody">
<form name="form" action="" method="get">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
    <td width="84">Ключевые слова</td>
    <td width="252"><input name="keyword" type="text" value="<?php echo $keyword; ?>" size="40"> </td>
    <td width="694">
	<input class="btn" type="submit" name="Submit2" value=" <?php echo lang_show('submit')?> "></td>
  </tr>
</table>
</form>
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
<form name="form" action="" method="post">
<div class="bigbox">
	<div class="bigboxhead">Управление ключевыми словами</div>
	<div class="bigboxbody">
	  <table width="100%" border="0" align="left" cellpadding="2" cellspacing="0" >
		<tr> 
		  <td width="49"><input onClick="do_select()" name="" type="checkbox"></td>
		  <td width="129">Слово</td>
		  <td width="227">Замена</td>
		  <td width="281">Статус</td>
		  <td width="147">Дата</td>
		  <td width="173">Действие</td>
		</tr>
		<?php
		$tsql=NULL;
		if($keyword)
			$tsql.=" and keyword like '%$_GET[keyword]%'"; 
		$sql="select * from ".FILTER." where 1 $tsql order by id desc";
		//=============================
		$page = new Page;
		$page->listRows=50;
		if (!$page->__get('totalRows')){
			$db->query($sql);
			$page->totalRows = $db->num_rows();
		}
		$sql .= "  limit ".$page->firstRow.",50";
		$pages = $page->prompt();
		//================================
		$db->query($sql);
		$re=$db->getRows();
		foreach($re as $va)
		{
		?> 
		<tr> 
		  <td><input name="de[]" id="de" type="checkbox" value="<?php echo $va['id']; ?>"></td>
		  <td><?php echo $va['keyword']; ?></td>
		  <td><?php echo $va['replace']; ?>&nbsp;</td>
		  <td><?php if($va['statu']==1) echo 'Запрет';else echo 'Замена'; ?>&nbsp;</td>
		  <td><?php echo date("Y-m-d",$va['time']); ?>&nbsp;</td>
		  <td>
		  <a href="?id=<?php echo $va['id'];?>">Удалить</a> |
		  <a href="add_filter_keyword.php?id=<?php echo $va['id'];?>">Изменить</a>
		  </td>
		</tr>
		<?php 
		}
		?> 
	  <tr>
      <td colspan="5" >
	  <input class="btn" type="submit" name="submit" value="Удалить" ></td>
      <td width="173" ><div class="page"><?php echo $pages?></div></td>
	  </tr>
  </table>
  </div>
</div>
</form>
</body>
</html>