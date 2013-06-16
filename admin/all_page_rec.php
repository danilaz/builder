<?php
include_once("../includes/global.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
include_once("../lang/" . $config['language'] . "/admin/global.php");
include_once("../lang/" . $config['language'] . "/admin/" . $sctiptName);
include_once("auth.php");
?>
<html>
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<body>
<link href="main.css" rel="stylesheet" type="text/css" />
<div class="bigbox">
	<div class="bigboxhead">
<?php
$sql="select * from ".PAGEREC." order by time desc";
$db->query($sql);
$Num=$db->num_rows();
$list=$db->getRows();
?>
<?php echo lang_show('trec');?><?php echo $Num?><?php echo lang_show('tdot');?>
</div>
<div class="bigboxbody">
<table width="100%" border="0" cellpadding="1" cellspacing="0">
  <tr>
    <td width="10%" align="center" ><?php echo lang_show('ttime');?></td>
    <td width="18%" align="center" ><?php echo lang_show('turls');?>/<?php echo lang_show('tpurls');?></td>
	<td width="12%" align="center" ><?php echo lang_show('tpvs');?>/<?php echo lang_show('tips');?></td>
	<td width="13%" align="center" >Онлайн user/новых</td>
	<td width="9%" align="center" ><?php echo lang_show('tpros');?></td>
	<td width="7%" align="center" ><?php echo lang_show('toffers');?></td>
	<td width="9%" align="center" >Инвестиций</td>
	<td width="6%" align="center" >Выставок</td>
	<td width="7%" align="center" >Новостей</td>
    <td width="9%" align="center" ><?php echo lang_show('vids');?></td>
  </tr>
<?php
if(is_array($list))
{
	foreach($list as $rec)
	{
	?>
	  <tr>
		<td align="center"><?php echo date('Y-m-d',strtotime($rec['time'])-3600*24);?></td>
		<td align="center"><?php echo $rec['totalurl'];?>  <?php echo $rec['mostpopularurl'];?></td>
		<td align="center"><?php echo $rec['pageviews'];?>/<?php echo $rec['totalip'];?></td>
		<td align="center"><?php echo $rec['visitusernum'];?>/<?php echo $rec['reguser'];?></td>
		<td align="center"><?php echo $rec['pronum'];?></td>
		<td align="center"><?php echo $rec['offernum'];?></td>
		<td align="center"><?php echo $rec['projnum'];?></td>
		<td align="center"><?php echo $rec['exhibnum'];?></td>
		<td align="center"><?php echo $rec['newsnum'];?></td>
		<td align="center"><?php echo $rec['videonum'];?></td>
	  </tr>
	<?php
	 }
 }
?>
</table>
</div>
</div>
</body>
</html>